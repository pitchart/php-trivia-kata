<?php


namespace Trivia;


class Category
{
    const POP = "Pop";

    const SCIENCE = "Science";

    const SPORTS = "Sports";

    const ROCK = "Rock";

    public static function all()
    {
        return [Category::POP, Category::ROCK, Category::SCIENCE, Category::SPORTS];
    }
}