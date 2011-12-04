<?php
namespace Wally;

/**
 * This class provides a simple diff function.
 * 
 * Refactored for personal scope on base written by Dave Marshall
 *
 * @package 	Wally
 * @author      Walter Dal Mut
 */
class Diff
{
    /**
     * Method to find longest common subsequences, based on
     * http://en.wikipedia.org/wiki/Longest_common_subsequence_problem
     *
     * @param string $s1
     * @param string $s2
     * @return array
     * @see http://en.wikipedia.org/wiki/Longest_common_subsequence_problem
     */
    protected function _lsm($s1, $s2)
    {
        $mStart = 0;
        $mEnd   = count($s1) - 1;
        $nStart = 0;
        $nEnd   = count($s2) - 1;
        $c = array();
        for($i = -1; $i <= $mEnd; $i++) {
            $c[$i] = array();
            for($j = -1; $j <= $nEnd; $j++) {
                $c[$i][$j] = 0;
            }
        }
        for($i = $mStart; $i <= $mEnd; $i++) {
            for($j = $nStart; $j <= $nEnd; $j++) {
                if ($s1[$i] == $s2[$j]) {
                    $c[$i][$j] = $c[$i -1][$j - 1] + 1;
                } else {
                    $c[$i][$j] = max($c[$i][$j - 1], $c[$i - 1][$j]);
                }
            }
        }
        return $c;
    }
 
    /**
     * Simple formatting of the array created by the <tt>lsm</tt> method.
     * Lines are printed as normal, lines that are only in the second string are
     * prefixed with '+', lines that are only in the first string are prefixed
     * with '-'
     *
     * @param array $c Output of <tt>lsm</tt> method
     * @param string First string
     * @param string Second String
     * @param int $i
     * @param int $j
     * @return string
     * @see lsm
     */
    protected function _printDiff($c, $s1, $s2, $i, $j)
    {  
        $diff = "";
        if ($i >= 0 && $j >= 0 && $s1[$i] == $s2[$j]) {
            $diff .= $this->_printDiff($c, $s1, $s2, $i - 1, $j - 1);
            $diff .= "  " . $s1[$i] . PHP_EOL;
        } else {
            if ($j >= 0 && ($i == -1 || $c[$i][$j - 1] >= $c[$i - 1][$j])) {
                $diff .= $this->_printDiff($c, $s1, $s2, $i, $j - 1);
                $diff .= "+ " . $s2[$j] . PHP_EOL;
            } else if ($i >= 0 && ($j == -1 || $c[$i][$j - 1] < $c[$i - 1][$j])) {
                $diff .= $this->_printDiff($c, $s1, $s2, $i - 1, $j);
                $diff .= "- " . $s1[$i] . PHP_EOL;
            }
        }
 
        return $diff;
    }
 
   
    /**
     * Given two strings, returns a string in the format describe by
     * Wally\Diff::printDiff
     *
     * @param string $s1 First String
     * @param string $s2 Second String 
     * @return string
     */
    public function getDiff($s1, $s2)
    {
        $s1 = explode("\n", $s1);
        $s2 = explode("\n", $s2);
        return $this->_printDiff($this->_lsm($s1, $s2), $s1, $s2, count($s1) - 1, count($s2) - 1);
    }
}