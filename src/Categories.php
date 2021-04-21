<?php


namespace Trivia;


class Categories
{
    const POP = "Pop";

    const SCIENCE = "Science";

    const SPORTS = "Sports";

    const ROCK = "Rock";

    public static function all()
    {
        return [Categories::POP, Categories::ROCK, Categories::SCIENCE, Categories::SPORTS];
    }
}