<?php

namespace LaraFilm\Application\Commands\Import;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use LaraFilm\Domain\Models\Tv\Tv as TvEntity;
use LaraFilm\Interfaces\Services\TvServiceInterface;
use LaraFilm\Interfaces\Services\GenreServiceInterface;
use LaraFilm\Interfaces\Services\PersonServiceInterface;
use LaraFilm\Interfaces\Services\CompanyServiceInterface;
use LaraFilm\Interfaces\Services\ActorServiceInterface;
use LaraFilm\Interfaces\Services\AssetServiceInterface;
use LaraFilm\Interfaces\Services\AssetImageServiceInterface;
use LaraFilm\Interfaces\Services\AssetVideoServiceInterface;
use LaraFilm\Interfaces\Services\SeasonServiceInterface;
use LaraFilm\Interfaces\Services\EpisodeServiceInterface;

use Pbmedia\LaravelFFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use FFMpeg\Filters\Gif\GifFilters;
use FFMpeg\Media\Gif;

use LaraFilm\Infrastructure\Exceptions\RecordNotFound;

class Tv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tv {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import from Kodi library';

    private $tvService;

    private $genreService;

    private $personService;

    private $companyService;

    private $actorService;

    private $assetService;

    private $assetImageService;

    private $assetVideoService;

    private $seasonService;

    private $episodeService;

    private $ffmpeg;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        TvServiceInterface $tvService,
        GenreServiceInterface $genreService,
        PersonServiceInterface $personService,
        CompanyServiceInterface $companyService,
        ActorServiceInterface $actorService,
        AssetServiceInterface $assetService,
        AssetImageServiceInterface $assetImageService,
        AssetVideoServiceInterface $assetVideoService,
        SeasonServiceInterface $seasonService,
        EpisodeServiceInterface $episodeService,
        FFMpeg $ffmpeg
    ) {
        parent::__construct();

        $this->tvService = $tvService;
        $this->genreService = $genreService;
        $this->personService = $personService;
        $this->companyService = $companyService;
        $this->actorService = $actorService;
        $this->assetService = $assetService;
        $this->assetImageService = $assetImageService;
        $this->assetVideoService = $assetVideoService;
        $this->seasonService = $seasonService;
        $this->episodeService = $episodeService;
        $this->ffmpeg = $ffmpeg;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->argument('path') . '/';
        $seasons = [];

        $dirInfo = scandir($path);

        $this->info('Scanning Directory...');
        foreach ($dirInfo as $file) {
            if (preg_match('/Season (.*)/', $file, $match)) {
                $season = (int)$match[1];

                $episodeDirInfo = scandir($path . $file);
                foreach ($episodeDirInfo as $episodeFile) {
                    if(preg_match('/S([0-9]*)E([0-9]*)/', $episodeFile, $episodeMatch)) {
                        $episode = (int)$episodeMatch[2];

                        $fileInfo = pathinfo($path . $file . '/' . $episodeFile);

                        if ($fileInfo['extension'] == 'jpg') {
                            $seasons[$season][$episode]['thumb'] = $fileInfo['basename'];
                        } elseif ($fileInfo['extension'] == 'nfo') {
                            $seasons[$season][$episode]['nfo'] = $fileInfo['basename'];
                        } else {
                            $seasons[$season][$episode]['video'] = $fileInfo['basename'];
                        }
                    }
                }
            }
        }

        $tv = $this->addTvShow();
        $this->addEpisode($tv, $seasons);
    }

    private function addEpisode(TvEntity $tv, $seasons)
    {
        $path = $this->argument('path') . '/';

        $seasonIds = [];

        foreach ($seasons as $season => $episodes) {
            $seasonIds[$season] =  $this->seasonService->create([
                'tvId' => $tv->id()->id(),
                'season' => $season,
                'name' => '',
                'plot' => ''
            ])->id()->id();
        }

        foreach ($seasons as $season => $episodes) {
            foreach ($episodes as $num => $episode) {
                $dir = $path . 'Season ' . str_pad($season, 2, 0, STR_PAD_LEFT) . '/';

                $xml = simplexml_load_file($dir . $episode['nfo']);
                $info = json_decode(json_encode($xml), true);

                $images = [];

                $this->info('Title: ' . $info['title']);

                if (isset($episode['video'])) {
                    $oldName = $dir . $episode['video'];
                    $newName = storage_path('app/temp/' . $episode['video']);

                    rename($oldName, $newName);

                    $video = $this->ffmpeg->open('temp/' . $episode['video']);

                    $videoInfo = $video->getFirstStream();
                    $duration = $video->getDurationInSeconds();

                    $fps = explode('/', $videoInfo->get('r_frame_rate'));

                    $this->info('Generating GIF Thumbnail');
                    $thumbnailAsset = $this->assetService->create(['type' => 2, 'extension' => 'gif']);
                    $images[] = $this->assetImageService->create($thumbnailAsset->id()->id(), 13);

                    /*
                    $video = $this->ffmpeg->open('temp/' . $episode['video']);
                    $video->addFilter('-ss', gmdate("H:i:s", $video->getDurationInSeconds() / 3))
                        ->addFilter('-to', gmdate("H:i:s", ($video->getDurationInSeconds() / 3) + 60))
                        ->addFilter(function ($filters) {
                            $filters->resize(new \FFMpeg\Coordinate\Dimension(1280, 720));
                        })
                        ->addFilter(new GifFilters(new Gif($video)))
                        ->export()
                        ->inFormat(new X264())
                        ->save('public/images/' . $thumbnailAsset->id()->id() . '.gif');
                    */

                    system('ffmpeg -y -ss ' . $video->getDurationInSeconds() / 3 . ' -t 30 -i "' . $newName . '" -vf fps=10,scale=320:180,palettegen ' . storage_path('app/temp/' . 'palette.png'));
                    system('ffmpeg -y -ss ' . $video->getDurationInSeconds() / 3 . ' -t 30 -i "' . $newName . '" -i ' . storage_path('app/temp/' . 'palette.png') . ' -filter_complex "fps=10,scale=320:180,paletteuse" ' . storage_path('app/public/images/' . $thumbnailAsset->id()->id() . '.gif'));

                    $video = $this->ffmpeg->open('temp/' . $episode['video']);

                    //$asset = $this->assetService->create(['type' => 1, 'extension' => 'mp4']);

                    $asset = $this->assetService->create(['type' => 1, 'extension' => 'm3u8']);


                    $videoAsset = $this->assetVideoService->create([
                        'assetId' => $asset->id()->id(),
                        'duration' => $duration,
                        'width' => $videoInfo->get('width'),
                        'height' => $videoInfo->get('height'),
                        'aspectRatio' => $videoInfo->get('display_aspect_ratio') ?? '16:9',
                        'fps' => $fps[0] / $fps[1]
                    ]);

                    /*
                    $progressBar = $this->output->createProgressBar(100);
                    $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

                    $videoPercentage = 0;

                    $format = new X264('libmp3lame');

                    $this->info('Encoding video...');
                    $format->on('progress', function($video, $format, $percentage) use ($progressBar, &$videoPercentage) {
                        if ($videoPercentage != $percentage) {
                            $videoPercentage = $percentage;
                            $progressBar->advance();
                        }
                    });

                    $progressBar->start();
                    $video->export()
                        ->withVisibility('public')
                        ->inFormat($format)
                        ->save('public/videos/' . $asset->id()->id() . '.' . $asset->extension()->value());
                    $progressBar->finish();
                    echo PHP_EOL;

                    */


                    //$lowBitrate = (new X264('libmp3lame'))->setKiloBitrate(250);
                    $highBitrate = (new X264('aac'))->setKiloBitrate(3000);

                    $progressBar = $this->output->createProgressBar(100);
                    $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

                    $videoPercentage = 0;
                    $progressBar->start();

                    $exporter = $this->ffmpeg->open('temp/' . $episode['video'])
                        ->exportForHLS()
                        /*
                        ->addFormat($lowBitrate, function($media) {
                            $media->addFilter(function ($filters) {
                                $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                            });
                        })
                        */
                        ->addFormat($highBitrate, function($media) {
                            $media->addFilter(function ($filters) {
                                $filters->resize(new \FFMpeg\Coordinate\Dimension(1280, 960));
                            })->addFilter(['-b:a', '320']);
                        })
                        ->onProgress(function($percentage) use (&$progressBar, &$videoPercentage) {
                            if ($videoPercentage != $percentage) {
                                $videoPercentage = $percentage;
                                $progressBar->advance();
                            }
                        })
                        ->save('public/videos/' . $asset->id()->id() . '.' . $asset->extension()->value());

                    $progressBar->finish();
                    echo PHP_EOL;

                    $videos = [$videoAsset];
                } else {
                    $videos = [];
                }

                if (isset($episode['thumb'])) {
                    $imagePath = $path . 'Season ' . str_pad($season, 2, 0, STR_PAD_LEFT);
                    $imagePath .= '/' . $episode['thumb'];

                    $fileInfo = pathinfo($imagePath);
                    $asset = $this->assetService->create(['type' => 2, 'extension' => $fileInfo['extension']]);
                    $images[] = $this->assetImageService->create($asset->id()->id(), 12);

                    $filePath = storage_path('app/public/images/' . $asset->id()->id() . '.' . $fileInfo['extension']);
                    copy($imagePath, $filePath);
                    $this->info('Copying episode\'s Thumbnail');
                } elseif(isset($episode['video'])) {
                    $asset = $this->assetService->create(['type' => 2, 'extension' => 'jpg']);
                    $images[] = $this->assetImageService->create($asset->id()->id(), 12);

                    $video = $this->ffmpeg->open('temp/' . $episode['video']);
                    $video->getFrameFromSeconds($video->getDurationInSeconds() / 3)
                        ->export()
                        ->save('public/images/' . $asset->id()->id() . '.jpg');
                }

                $this->episodeService->create([
                    'seasonId' => $seasonIds[$season],
                    'title' => $info['title'],
                    'plot' => $xml->plot, // Bug
                    'aired' => $info['aired'],
                    'rating' => $info['rating'],
                    'votes' => $info['votes'],
                    'episode' => $info['episode'],
                    'images' => $images,
                    'videos' => $videos
                ]);
            }
        }
    }

    private function addTvShow()
    {
        $path = $this->argument('path') . '/';
        $tvShow = $path . 'tvshow.nfo';
        $poster = $path . 'poster.jpg';
        $logo = $path . 'logo.png';
        $banner = $path . 'banner.jpg';
        $background = $path. 'fanart.jpg';
        $clearArt = $path . 'clearart.png';

        $imageSet[0] = $logo;
        $imageSet[1] = $poster;
        $imageSet[4] = $clearArt;
        $imageSet[8] = $background;
        $imageSet[9] = $banner;

        $xml = simplexml_load_file($tvShow);
        $info = json_decode(json_encode($xml), true);

        if ($info['mpaa'] == '' || is_array($info['mpaa'])) {
            $info['mpaa'] = 'TV-12';
        }

        $data = [
            'name' => $info['title'],
            'plot' => $info['plot'] ?? 'Plot',
            'mpaa' => $info['mpaa'],
            'year' => $info['year'] ?? 2000,
            'rating' => $info['rating'] ?? 0,
            'votes' => $info['votes'] ?? 0,
            'studios' => [],
            'genres' => [],
            'actors' => [],
            'images' => [],
            'status' => 1
        ];

        $this->info('Add new Company.');

        try {
            $company = $this->companyService->findByName($info['studio']);
        } catch (RecordNotFound $e) {
            $company = $this->companyService->create($info['studio']);
        }

        $studios = [$company];

        $genres = [];
        $actors = [];
        $images = [];

        $client = new Client();

        /*
        foreach ($info['actor'] ?? [] as $actor) {
            $actorImage = false;

            if (!isset($actor['role']) || $actor['role'] == '' || is_array($actor['role'])) {
                break;
            }

            if (isset($actor['thumb']) && !is_array($actor['thumb'])) {
                $actorImage = true;
                $asset = $this->assetService->create(['type' => 2, 'extension' => 'jpg']);
                $imageAsset = $this->assetImageService->create($asset->id()->id(), 11);

                $filePath = storage_path('app/public/images/' . $asset->id()->id() . '.jpg');
                $fileStream = fopen($filePath, 'w');

                $this->info('Downloading from ' . $actor['thumb']);

                try {
                    $client->request('GET', $actor['thumb'], ['sink' => $fileStream]);
                } catch (\Exception $e) {
                    $this->error('Failed to download thumb');
                    $this->assetImageService->delete($imageAsset);
                    $this->assetService->delete($asset);
                    $actorImage = false;
                }
            }

            $actorImage = $actorImage ? [$imageAsset->id()->id()] : [];

            $this->info('Add new person: ' . $actor['name']);
            $person = $this->personService->create([
                'name' => $actor['name'],
                'images' => $actorImage
            ]);
            $actors[] = $this->actorService->create($person->id()->id(), $actor['role']);
        }
        */

        if (!is_array($info['genre'])) {
            $genre = $info['genre'];
            $info['genre'] = [$genre];
        }

        foreach ($info['genre'] ?? [] as $genre) {
            $genres[] = $this->genreService->create($genre);
        }

        foreach ($imageSet as $type => $path) {
            if (file_exists($path)) {
                $fileInfo = pathinfo($path);

                $asset = $this->assetService->create(['type' => 2, 'extension' => $fileInfo['extension']]);
                $images[] = $this->assetImageService->create($asset->id()->id(), $type);

                $filePath = storage_path('app/public/images/' . $asset->id()->id() . '.' . $fileInfo['extension']);
                copy($path, $filePath);
            }
        }

        $data['studios'] = $studios;
        $data['genres'] = $genres;
        $data['actors'] = $actors;
        $data['images'] = $images;

        $tv = $this->tvService->create($data);
        $this->info('Import tvshow.nfo Completed.');

        return $tv;
    }
}
