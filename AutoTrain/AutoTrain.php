<?php

    namespace AutoTrain;

    use AutoTrain\Helpers\Path;
    use Exception;

    class AutoTrain {
        public static function start(): void {
            header('Content-Type: application/json');
            echo json_encode(self::run());
        }

        /**
         * @param string $file
         * @return array{
         *     steps: array{
         *         initial: int,
         *         final: int
         *     },
         *     error: string
         * }
         */
        public static function run(string $file = ''): array {
            $response = [];

            try {
                $steps = Path::getSteps($file);
                $response['steps'] = self::solve($steps);
            } catch (Exception $error) {
                $response['error'] = $error->getMessage();
            } finally {
                return $response;
            }
        }

        /**
         * @param string[] $steps
         * @return array{
         *     initial: int,
         *     final: int
         * }
         */
        public static function solve(array $steps): array {
            $currentPosition = 0;

            foreach ($steps as $step) {
                $currentPosition = match ($step) {
                    Path::RIGHT => $currentPosition + 1,
                    Path::LEFT => $currentPosition - 1,
                };
            }

            return [
                'initial' => 0,
                'final' => $currentPosition
            ];
        }
    }
