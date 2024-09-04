<?php

    use AutoTrain\Helpers\Path;

    describe('discover paths', function() {
        it('may turn coordinate into list', function () {
            expect(!empty(count(Path::getPath('DIREITA, ESQUERDA'))))
                ->toBeTrue();
        });

        it('may return empty', function () {
            expect(empty(count(Path::getPath(''))))
                ->toBeTrue();
        });

        it('may return all 3 elements', function () {
            expect(count(Path::getPath('DIREITA, ESQUERDA, DIREITA')))
                ->toBe(3);
        });

        it('may return all 7 elements', function () {
            expect(count(Path::getPath('DIREITA, ESQUERDA, DIREITA, ESQUERDA, ESQUERDA, ESQUERDA, ESQUERDA')))
                ->toBe(7);
        });

        it('may return Exception for empty', function () {
            Path::getSteps(__DIR__.'/01_empty.txt');
        })->throws(Exception::class);

        it('may return Exception for more elements than limit', function () {
            Path::getSteps(__DIR__.'/02_bigger_than_limit.txt');
        })->throws(Exception::class);

        it('may return Exception for lower case words', function () {
            Path::getSteps(__DIR__.'/04_invalid_steps.txt');
        })->throws(Exception::class);

        it('may return Exception for invalid words', function () {
            Path::getSteps(__DIR__.'/05_invalid_words.txt');
        })->throws(Exception::class);
    });
