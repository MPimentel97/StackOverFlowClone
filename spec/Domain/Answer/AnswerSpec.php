<?php

namespace spec\App\Domain\Answer;

use App\Domain\Answer\Answer;
use App\Domain\Question\Question;
use App\Domain\UserManagement\User;
use App\Domain\Vote\Vote;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AnswerSpec extends ObjectBehavior
{
    private $body;
    private $correctAnswer;
    private $date;
    private $positiveVote;
    private $negativeVote;
    private $votes;

    /**
     * @param User $user
     * @param Question $question
     * @throws \Exception
     */
    function let(Question $question, User $user)
    {

        $this->body = 'this is a body';
        $this->correctAnswer = false;
        $this->votes = $votes = [];
        $this->date = new DateTimeImmutable('2000-01-01');
        $this->positiveVote = 1;
        $this->negativeVote = 0;
        $this->beConstructedWith($this->body,$question->getWrappedObject(),$user->getWrappedObject());

    }

    function it_can_return_votes()
    {
        $this->getVotes()->shouldBeArray();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Answer::class);
    }

    function it_updates_body()
    {
        $body = $this->body;
        $this->update_body($body)->shouldBe($this->body);
        $this->getBody()->shouldBe($this->body);
    }

    function it_as_a_correct_answer()
    {
       $this->isCorrectAnswer()->shouldBe($this->correctAnswer);
    }

    function it_can_set_an_answer_correct()
    {
        $this->setAsCorrect()->shouldBe(true);
    }

    function it_can_return_a_positive_vote()
    {
        $this->ispositiveVote()->shouldBe(true);
    }

    function it_can_add_a_vote()
    {
        $this->addVote(vote::negative())->shouldBeAnInstanceOf(Vote::class);
        $this->addVote(vote::positive())->shouldBeAnInstanceOf(Vote::class);
    }
}