<?php

namespace LaraFilm\Application\Commands\Import;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use LaraFilm\Domain\Models\Tv\Tv as TvEntity;
use LaraFilm\Application\Services\SeasonService;
use LaraFilm\Interfaces\Services\TvServiceInterface;
use LaraFilm\Interfaces\Services\GenreServiceInterface;
use LaraFilm\Interfaces\Services\PersonServiceInterface;
use LaraFilm\Interfaces\Services\CompanyServiceInterface;
use LaraFilm\Interfaces\Services\ActorServiceInterface;
use LaraFilm\Interfaces\Services\AssetServiceInterface;
use LaraFilm\Interfaces\Services\AssetImageServiceInterface;
use LaraFilm\Interfaces\Services\SeasonServiceInterface;
use LaraFilm\Interfaces\Services\EpisodeServiceInterface;

use Pbmedia\LaravelFFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;

class Video extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:video {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import video to library';

    private $tvService;

    private $genreService;

    private $personService;

    private $companyService;

    private $actorService;

    private $assetService;

    private $assetImageService;

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
        $file = $this->argument('file');
        $pathInfo = pathinfo($file);

        $target = $pathInfo['dirname'] . '/' . $pathInfo['basename'];

        $progressBar = $this->output->createProgressBar(100);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $videoPercentage = 0;

        $format = new X264('libmp3lame');

        $progressBar->setMessage('Start');
        $progressBar->start();
        $format->on('progress', function($video, $format, $percentage) use ($progressBar, &$videoPercentage) {
            if ($videoPercentage != $percentage) {
                $videoPercentage = $percentage;
                $progressBar->advance();
            }
        });

        //dd($this->ffmpeg->open($target)->getDurationInSeconds());
        dd($this->ffmpeg->open($target)->getFirstStream());

        $video = $this->ffmpeg->open($target)
            ->export()
            ->withVisibility('public')
            ->inFormat($format);

        $video->save('my_movie.mp4');


        $progressBar->finish();

        echo PHP_EOL;

        $this->info('convert video complete.');
    }
}
