<?php

namespace LaraFilm\Application\Commands\Import;

use Illuminate\Console\Command;
use LaraFilm\Interfaces\Services\TvServiceInterface;
use LaraFilm\Interfaces\Services\GenreServiceInterface;
use LaraFilm\Interfaces\Services\PersonServiceInterface;
use LaraFilm\Interfaces\Services\CompanyServiceInterface;
use LaraFilm\Interfaces\Services\ActorServiceInterface;

class Tv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tv {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import from tvshow.nfo file';

    private $tvService;

    private $genreService;

    private $personService;

    private $companyService;

    private $actorService;

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
        ActorServiceInterface $actorService
    ) {
        parent::__construct();

        $this->tvService = $tvService;
        $this->genreService = $genreService;
        $this->personService = $personService;
        $this->companyService = $companyService;
        $this->actorService = $actorService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->argument('file');

        $xml = simplexml_load_file($file);
        $info = json_decode(json_encode($xml), true);

        $data = [
            'name' => $info['title'],
            'plot' => $info['plot'],
            'mpaa' => $info['mpaa'],
            'year' => $info['year'],
            'rating' => $info['rating'],
            'votes' => $info['votes'],
            'status' => 1
        ];

        $company = $this->companyService->create($info['studio']);
        $studios = [$company];

        $genres = [];
        $actors = [];

        foreach ($info['actor'] as $actor) {
           $person = $this->personService->create($actor['name']);
           $actors[] = $this->actorService->create($person->id()->id(), $actor['role']);
        }

        foreach ($info['genre'] as $genre) {
            $genres[] = $this->genreService->create($genre);
        }

        $data['studios'] = $studios;
        $data['genres'] = $genres;
        $data['actors'] = $actors;

        $this->tvService->create($data);
    }
}
