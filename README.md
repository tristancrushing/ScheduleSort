# ScheduleSort
A humorous take on sorting algorithms inspired by a programmer meme. This repository contains the ScheduleSort PHP class, a playful simulation of a sorting algorithm, It's a fun educational tool to demonstrate the importance of efficiency in algorithms and the amusing misuse of process scheduling. Includes the original meme for context.

# ScheduleSort - A Humorous Sorting Algorithm Simulation

`ScheduleSort` is a PHP class that humorously simulates a sorting algorithm based on a popular programmer meme. It 'sorts' numbers by artificially using `usleep` to simulate process scheduling based on the value of the numbers. This repository includes the PHP class implementation of this concept and the original meme that inspired it.

## Background

The meme (included in the repository) jokingly suggests an algorithm that delegates sorting to the CPU scheduler, an intentionally inefficient and amusing misuse of system resources. This repository turns that joke into code, offering a fun way to understand the absurdity and inefficiency of such an approach while also appreciating the importance of proper algorithm design.

## The `ScheduleSort` Class

The `ScheduleSort` class in PHP provides two static methods:
- `sort`: Sorts an array of integers using the simulated algorithm.
- `sortWithTime`: Sorts the array and returns the sorting time, including the total 'sleep' time simulating process scheduling.

This class is purely for educational and entertainment purposes and not intended for practical use in sorting operations.

## Usage

To use `ScheduleSort`, include the `ScheduleSort.php` file in your PHP script, and call its methods with an array of integers. The script can also process numbers provided via a GET request, returning results in JSON or a Bootstrap-styled HTML table.

Example:

```php
require 'ScheduleSort.php';

$numbersToSort = [102, 3, 25, 76, 84, 12, 35, 68, 90, 11];
$result = ScheduleSort::sortWithTime($numbersToSort);

print_r($result);
```

## Demo

You can see the `ScheduleSort` in action at [this demo link](https://ipspy.net/ScheduleSort.php?numbers=965,261,874,484,43,370,165,25,748,7,67,857,276,397,212,892,273,218,175,767,252,331,570,979,466,670,719,184,437,506,230,219,991,862,897,439,510,372,385,886,88,186,626,90,877,592,867,11,926,608,900,472,942,806,566,544,475,237,483,866,357,200,530,823,31,113,285,143,967,244,648,421,68,633,324,775,763,240,148,764,707,667,26,913,876,420,528,620,688,294,272,735,305,232,800,485,222,736,537,801).


## Contributing

Feel free to fork this repository, submit pull requests, or suggest improvements or additional features.
