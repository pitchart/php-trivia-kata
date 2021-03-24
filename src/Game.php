<?php


namespace Trivia;

function echoln($string) {
    echo $string."\n";
}

class Game {
    /**
     * @var array | Player[]
     */
    private $players = array();

    var $purses = array(0);
    var $inPenaltyBox = array(0);

    /**
     * @var array | Question[]
     */
    var $popQuestions = [];
    /**
     * @var array | Question[]
     */
    var $scienceQuestions = [];
    /**
     * @var array | Question[]
     */
    var $sportsQuestions = [];
    /**
     * @var array | Question[]
     */
    var $rockQuestions = [];

    var $currentPlayer = 0;
    var $isGettingOutOfPenaltyBox;

    private $maxPlaces = 12;

    public function  __construct(){
        for ($i = 0; $i < 50; $i++) {
            array_push($this->popQuestions, $this->createQuestion(Category::POP, $i));
            array_push($this->scienceQuestions, $this->createQuestion(Category::SCIENCE, $i));
            array_push($this->sportsQuestions, $this->createQuestion(Category::SPORTS, $i));
            array_push($this->rockQuestions, $this->createQuestion(Category::ROCK, $i));
        }
    }

    private function createQuestion(string $category, int $index): Question
    {
        $questionLabel = $this->createLabel($category);
        return new Question($questionLabel. " ".$index, $category);
    }

    private function createLabel(string $category)
    {
        switch ($category) {
            case Category::SPORTS:
                return "Sports Question";
            case Category::ROCK:
                return "Rock Question";
            case Category::SCIENCE:
                return "Science Question";
            case Category::POP:
                return "Pop Question";
        }
        throw new \InvalidArgumentException(sprintf(
            '$category must be in [%s], %s given',
            implode(', ', Category::all()),
            $category
        ));
    }

    /**
     * @param $roll
     */
    public function getQuestion($roll): void
    {
        $this->players[$this->currentPlayer]->changePlace($roll, $this->maxPlaces);

        echoln($this->players[$this->currentPlayer]
            . "'s new location is "
            . $this->getCurrentPlayerPlace());
        echoln("The category is " . $this->currentCategory());
        $this->askQuestion();
    }

    private function isPlayable() {
        return ($this->howManyPlayers() >= 2);
    }

    public function addPlayer($playerName) {
        array_push($this->players, new Player($playerName));
        $this->purses[$this->howManyPlayers()] = 0;
        $this->inPenaltyBox[$this->howManyPlayers()] = false;

        echoln($playerName . " was added");
        echoln("They are player number " . count($this->players));
        return true;
    }

    public function howManyPlayers() {
        return count($this->players);
    }

    public function  roll($roll) {
        echoln($this->players[$this->currentPlayer] . " is the current player");
        echoln("They have rolled a " . $roll);

        if ($this->inPenaltyBox[$this->currentPlayer]) {
            if ($roll % 2 != 0) {
                $this->isGettingOutOfPenaltyBox = true;
                echoln($this->players[$this->currentPlayer] . " is getting out of the penalty box");

                $this->getQuestion($roll);
            } else {
                echoln($this->players[$this->currentPlayer] . " is not getting out of the penalty box");
                $this->isGettingOutOfPenaltyBox = false;
            }

        } else {
            $this->getQuestion($roll);
        }

    }

    private function  askQuestion() {
        if ($this->currentCategory() == Category::POP)
            echoln(array_shift($this->popQuestions)->getLabel());
        if ($this->currentCategory() == Category::SCIENCE)
            echoln(array_shift($this->scienceQuestions)->getLabel());
        if ($this->currentCategory() == Category::SPORTS)
            echoln(array_shift($this->sportsQuestions)->getLabel());
        if ($this->currentCategory() == Category::ROCK)
            echoln(array_shift($this->rockQuestions)->getLabel());
    }


    private function currentCategory() {
        switch ($this->getCurrentPlayerPlace() % 4) {
            case 0:
                return Category::POP;
            case 1:
                return Category::SCIENCE;
            case 2:
                return Category::SPORTS;
            default:
                return Category::ROCK;
        }
    }

    public function correctAnswer() {
        if (!$this->inPenaltyBox[$this->currentPlayer]
            || $this->isGettingOutOfPenaltyBox
        ) {
            echoln("Answer was correct!!!!");
            $this->purses[$this->currentPlayer]++;
            echoln($this->players[$this->currentPlayer]
                . " now has "
                .$this->purses[$this->currentPlayer]
                . " Gold Coins.");
        }
        $this->nextPlayer();
    }

    public function wrongAnswer(){
        echoln("Question was incorrectly answered");
        echoln($this->players[$this->currentPlayer] . " was sent to the penalty box");
        $this->inPenaltyBox[$this->currentPlayer] = true;

        $this->nextPlayer();
    }

    public function isEnded(): bool
    {
        foreach ($this->purses as $purse) {
            if ($purse >= 6) {
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
