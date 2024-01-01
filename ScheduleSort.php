<?php

/**
 * Class ScheduleSort
 * 
 * Author: Tristan McGowan
 * Email: tristan@ipspy.net
 *
 * A simulation of a humorous 'sorting' algorithm based on a programmer meme.
 * It sorts an array of integers by simulating the scheduling of processes 
 * with priorities inversely proportional to the integer values.
 *
 * This class is for educational or entertainment purposes and is not intended
 * for use in production environments.
 */
class ScheduleSort
{
    /**
     * A static array to hold the sorted values.
     *
     * @var array
     */
    private static $sortedArray = [];
    private static $totalSleepTime = 0; // Variable to track total usleep time


    /**
     * Sorts an array of numbers using the Schedule-Sort algorithm.
     *
     * @param array $numbers The array of numbers to sort.
     * @return array The sorted array.
     */
    public static function sort(array $numbers): array
    {
        // Reset the static sorted array before beginning the sort.
        self::$sortedArray = [];
        self::$totalSleepTime = 0; // Reset sleep time for each sort

        // Iterate over each number, simulating the scheduling of each as a process.
        foreach ($numbers as $number) {
            self::scheduleProcess($number);
        }

        // Use the built-in sort function to sort the array to mimic the CPU scheduler's behavior.
        sort(self::$sortedArray);

        return self::$sortedArray;
    }

    /**
     * Sorts an array of numbers and also returns the time taken to sort.
     *
     * @param array $numbers The array of numbers to sort.
     * @return array An associative array containing the sorted array and the time taken.
     */
    public static function sortWithTime(array $numbers): array
    {
        // Clear any previous values from the sorted array.
        self::$sortedArray = [];
        self::$totalSleepTime = 0; // Reset sleep time

        // Capture the start time in microseconds.
        $startTime = microtime(true);

        // Process each number in the array.
        foreach ($numbers as $number) {
            self::scheduleProcess($number);
        }

        // Use the built-in sort function as a CPU scheduler would order processes by priority.
        sort(self::$sortedArray);

        // Calculate the time taken by subtracting the start time from the current time.
        $endTime = microtime(true);
        $timeTaken = $endTime - $startTime;

        // Return the sorted array and the time taken as an associative array.
        return [
            'sortedArray' => self::$sortedArray,
            'timeTaken' => $timeTaken,
            'totalSleepTime' => self::$totalSleepTime // Return the total usleep time
        ];
    }

    /**
     * Simulates the scheduling of a process by using usleep.
     *
     * @param int $number The number representing the process's priority.
     */
    private static function scheduleProcess($number): void
    {
        $sleepTime = $number * 1000; // Calculate sleep time
        // Delay the process based on its 'priority', with usleep simulating process waiting.
        // The priority is determined by the value of the number (lower value = higher priority).
        usleep($number * 1000);

        // Append the number to the sorted array once the 'process' has 'completed'.
        self::$sortedArray[] = $number;
        self::$totalSleepTime += $sleepTime / 1000000; // Convert to seconds and add to total
    }
    
}

// Example usage:

// Default format is JSON
$format = isset($_GET['format']) ? $_GET['format'] : 'json';

// Check if the 'numbers' GET variable exists
if (isset($_GET['numbers'])) {
    // Sanitize and split the numbers into an array
    $numbersString = filter_input(INPUT_GET, 'numbers', FILTER_SANITIZE_STRING);
    $numbersArray = explode(',', $numbersString);

    // Convert each value to an integer
    $numbersToSort = array_map('intval', $numbersArray);

    // Sort the numbers using the ScheduleSort class
    $result = ScheduleSort::sortWithTime($numbersToSort);

    // Check the desired format
    if (strtolower($format) == 'html') {
        // Output results in an HTML table with Bootstrap styling
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
        echo '<div class="container mt-4">';
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>Sorted Numbers</th><th>Time Taken (seconds)</th><th>Total Sleep Time (seconds)</th></tr></thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>' . implode(', ', $result['sortedArray']) . '</td>';
        echo '<td>' . $result['timeTaken'] . '</td>';
        echo '<td>' . $result['totalSleepTime'] . '</td>';
        echo '</tr>';
        echo '</tbody></table></div>';
    } else {
        // Default to JSON output
        header('Content-Type: application/json');
        echo json_encode($result);
    }
} else {
    // Check the desired format
    if (strtolower($format) == 'html') {
        // Output results in an HTML table with Bootstrap styling
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
        echo "<pre class=\"danger\">Please provide a list of numbers in the 'numbers' GET variable.</pre>";
    } else {
        // Default to JSON output
        header('Content-Type: application/json');
        $result = ['status' => 'error', 'message' => 'Please provide a list of numbers in the \'numbers\' GET variable.'];
        echo json_encode($result);
    }
}


