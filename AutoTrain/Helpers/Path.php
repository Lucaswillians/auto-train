<?php

    namespace AutoTrain\Helpers;

    use Exception;

    class Path {
        public const RIGHT = 'DIREITA';
        public const LEFT = 'ESQUERDA';

        private const PATH_LIMIT = 50;
        private const DIRECTION_LIMIT = 20;

        /**
         * @throws Exception
         */
        public static function getSteps(string $file = ''): array {
            $paths = self::getPath(self::getFileContent($file));

            if (empty($paths)) {
                throw new Exception('Paths can not be empty');
            }

            if (count($paths) > self::PATH_LIMIT) {
                throw new Exception('Paths can not be more than 50');
            }

            $right = [];
            $left = [];

            $leftCount = 0;
            $rightCount = 0;

            foreach ($paths as $path) {
                if (
                    $leftCount === self::DIRECTION_LIMIT ||
                    $rightCount === self::DIRECTION_LIMIT
                ) {
                    throw new Exception('Each step can not have a sequence bigger than 20');
                }

                if ($path === self::RIGHT) {
                    $right[] = $path;

                    $leftCount = 0;
                    $rightCount++;
                }

                if ($path === self::LEFT) {
                    $left[] = $path;

                    $rightCount = 0;
                    $leftCount++;
                }
            }

            if ((count($right) + count($left)) !== count($paths)) {
                throw new Exception('Steps must be DIREITA and ESQUERDA only');
            }

            return $paths;
        }

        private static function getFileContent(string $path = ''): string {
            return file_get_contents( $path ?: __DIR__.'/../../train.txt');
        }

        public static function getPath(string $fileContent): array {
            $paths = explode(",", $fileContent);

            $sortedPaths = [];
            foreach ($paths as $path) {
                $path = trim($path);

                if (empty($path)) continue;

                $sortedPaths[] = $path;
            }

            return $sortedPaths;
        }
    }
