<?php

    use AutoTrain\AutoTrain;
    use AutoTrain\Helpers\Path;

    describe('run autonomous solver', function () {
        it ('may return error for empty content', function () {
            $response = AutoTrain::run(__DIR__.'/01_empty.txt');

            expect($response['error'])->toBe('Paths can not be empty');
        });

        it ('may return error for bigger content than limit', function () {
            $response = AutoTrain::run(__DIR__.'/02_bigger_than_limit.txt');

            expect($response['error'])->toBe('Paths can not be more than '.Path::PATH_LIMIT);
        });

        it ('may return error for steps sequence bigger than limit', function () {
            $response = AutoTrain::run(__DIR__.'/03_steps_sequence_bigger_than_limit.txt');

            expect($response['error'])->toBe('Each step can not have a sequence bigger than '.Path::DIRECTION_LIMIT);
        });

        it ('may return error for steps with lower case', function () {
            $response = AutoTrain::run(__DIR__.'/04_invalid_steps.txt');

            expect($response['error'])->toBe('Steps must be '.Path::RIGHT.' and '.Path::LEFT.' only');
        });

        it ('may return error for invalid steps', function () {
            $response = AutoTrain::run(__DIR__.'/05_invalid_words.txt');

            expect($response['error'])->toBe('Steps must be '.Path::RIGHT.' and '.Path::LEFT.' only');
        });

        it ('may return -1 for path', function () {
            $response = AutoTrain::run(__DIR__.'/06_command_to_left.txt');

            expect($response['steps']['final'])->toBe(-1);
        });

        it ('may return 1 for path', function () {
            $response = AutoTrain::run(__DIR__.'/07_command_to_right.txt');

            expect($response['steps']['final'])->toBe(1);
        });

        it ('may return 0 for path', function () {
            $response = AutoTrain::run(__DIR__.'/08_command_to_center.txt');

            expect($response['steps']['final'])->toBe(0);
        });
    });
