<?php

    namespace AutoTrain;

    use AutoTrain\Helpers\Path;
    use Exception;

    class AutoTrain {
        public static function start(): void {
            $response = [];

            try {
                $steps = Path::getSteps();
                $response['steps'] = self::solve($steps);
            } catch (Exception $error) {
                $response['error'] = $error->getMessage();
            } finally {
                header('Content-Type: application/json');
                echo json_encode($response);
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
