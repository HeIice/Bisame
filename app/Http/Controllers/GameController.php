<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Log;
use App\Http\Requests;
use App\Repositories\GameRepository;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\AnnotationRepository;

class GameController extends Controller
{
    protected $gameRepository;
    protected $annotationRepository;
    protected $gameSentenceIndex;

    protected function get_game_repository()
    {
        return $this->gameRepository;
    }

    public function __construct(GameRepository $gameRepository, AnnotationRepository $annotationRepository)
    {
        $this->gameRepository = $gameRepository;
        $this->annotationRepository = $annotationRepository;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = $this->get_or_create_game();
        return Redirect::route('games.show', ['id' => $game->id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repository = $this->get_game_repository();
        $game = $repository->getById($id);
        $sentences = $game->sentences;

        # ici, il faut créer un
        # words_postags : [...]
        return view('games.show', compact('sentences', 'game'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $repository = $this->get_game_repository();
        $game = $repository->getById($id);
        $new_index = $game->sentence_index + 1;
        if ($request->input('annotations')) {
            $this->create_annotations($request->input('annotations'));
        }
        if ($new_index >= $game->sentences->count()) {
            $game->is_finished = true;
            $game->save();
            return;
         } else {
            $game->sentence_index = $new_index;
            $game->save();
            $sentence = $game->sentences[$new_index];
            return view('games.sentence', compact('sentence'));
        }
    }

    private function create_annotations($annotations) 
    {
        $current_user = Auth::user();
        foreach ($annotations as $annotation) {
            $postag_id = $annotation['postag_id'];
            $word_id = $annotation['word_id'];
            if ($postag_id && $word_id) {
                $annotation = $this->annotationRepository->store(['user_id' => $current_user->id,
                    'word_id' => $word_id, 'postag_id' => $postag_id]);
            }
        }
    }

    protected function get_or_create_game() {
        $current_user = Auth::user();
        $repository = $this->get_game_repository();
        $game = $repository->getWithUserId($current_user->id)->first();
        if (!$game) {
            $game = $repository->store(['user_id' => $current_user->id, 'sentence_index' => 0]);
        }
        return $game;
    }

}