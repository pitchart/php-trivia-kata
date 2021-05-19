<?php


namespace Trivia;

class Game {
    /**
     * @var array | Player[]
     */
    private $players = array();

    /**
     * @var Category
     */
    var $popQuestions;
    /**
     * @var Category
     */
    var $scienceQuestions;
    /**
     * @var Category
     */
    var $sportsQuestions;
    /**
     * @var Category
     */
    var $rockQuestions;

    /**
     * @var CategoryCollection
     */
    private $categoryCollection;

    var $currentPlayer = 0;
    var $isGettingOutOfPenaltyBox;

    private $maxPlaces = 12;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var DiceInterface
     */
    private $dice;

    /**
     * Game constructor.
     *
     * @param OutputInterface $output
     */
    public function  __construct(
        OutputInterface $output,
        CategoryCollection $categoryCollection,
        ?DiceInterface $dice = null
    ){
        $this->output = $output;
        if (null == $dice) $dice = new Dice(6);
        $this->dice = $dice;

        $this->categoryCollection = $categoryCollection;
    }

    /**
     * @param $roll
     */
    public function getQuestion($roll): void
    {
        $this->players[$this->currentPlayer]->changePlace($roll, $this->maxPlaces);

        $this->output->write($this->players[$this->currentPlayer]
            . "'s new location is "
            . $this->getCurrentPlayerPlace());
        $this->output->write("The category is " . $this->currentCategory());
        $this->askQuestion();
    }

    private function isPlayable() {
        return ($this->howManyPlayers() >= 2);
    }

    /**
     * @param Player $player
     * @return bool
     */
    public function addPlayer(Player $player) {
        array_push($this->players, $player);

        $this->output->write($player . " was added");
        $this->output->write("They are player number " . count($this->players));
        return true;
    }

    public function howManyPlayers() {
        return count($this->players);
    }

    public function  roll() {
        $roll = $this->dice->roll();

        if (!$this->isPlayable()){
            throw new \LogicException("Need at least 2 players");
        }

        $this->output->write($this->players[$this->currentPlayer] . " is the current player");
        $this->output->write("They have rolled a " . $roll);

        if ($this->players[$this->currentPlayer]->isInPenaltyBox()) {
            if ($roll % 2 != 0) {
                $this->isGettingOutOfPenaltyBox = true;
                $this->output->write($this->players[$this->currentPlayer] . " is getting out of the penalty box");

                $this->getQuestion($roll);
            } else {
                $this->output->write($this->players[$this->currentPlayer] . " is not getting out of the penalty box");
                $this->isGettingOutOfPenaltyBox = false;
            }

        } else {
            $this->getQuestion($roll);
        }

    }

    private function  askQuestion() {
        $question = $this->categoryCollection->next($this->currentCategory());
        if ($question)
        {
            $this->output->write($question->getLabel());
        }
    }


    private function currentCategory() {
        switch ($this->getCurrentPlayerPlace() % 4) {
            case 0:
                return Categories::POP;
            case 1:
                return Categories::SCIENCE;
            case 2:
                return Categories::SPORTS;
            default:
                return Categories::ROCK;
        }
    }

    public function correctAnswer() {
        if (!$this->players[$this->currentPlayer]->isInPenaltyBox()
            || $this->isGettingOutOfPenaltyBox
        ) {
            $this->output->write("Answer was correct!!!!");
            $this->players[$this->currentPlayer]->incrementPurse();
            $this->output->write($this->players[$this->currentPlayer]
                . " now has "
                .$this->players[$this->currentPlayer]->getPurse()
                . " Gold Coins.");
        }
        $this->nextPlayer();
    }

    public function wrongAnswer(){
        $this->output->write("Question was incorrectly answered");
        $this->output->write($this->players[$this->currentPlayer] . " was sent to the penalty box");
        $this->players[$this->currentPlayer]->enterPenaltyBox();

        $this->nextPlayer();
    }

    public function isEnded(): bool
    {
        foreach ($this->players as $player) {
            if ($player->getPurse() >= 6) {
                return true;
            }
        }
        return false;
    }

    private function getCurrentPlayerPlace(): int
    {
        return $this->players[$this->currentPlayer]->getPlace();
    }

    private function nextPlayer()
    {
        $this->currentPlayer++;
        if ($this->currentPlayer == count($this->players)) $this->currentPlayer = 0;
    }

}
