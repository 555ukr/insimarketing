<?php

namespace Database\Seeders\MoviesParser;

interface ParserContract {

    public function run();

    public function validate(array $lineFile);
}