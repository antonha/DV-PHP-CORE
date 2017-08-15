<?php

namespace Devless\RulesEngine;

trait mathLib
{

    /**
     * Perform mathematical operations eg: `->beforeQuerying()->calculate(3*5)->storeAs($ans)->stopAndOutput(1001,'got answer successfully', $ans)`
     *
     * @param mathmatical expression
     *
     * @return $this
     */
    public function calculate($expression)
    {  
        if (!$this->execOrNot) {
                return $this;
        }

        $this->results = $expression;
        return $this;
    }
    /**
     * find the sum of numbers. eg: `->beforeQuerying()->sumUp(3,4,5,6,7)->storeAs($ans)->stopAndOutput(1001,'got answer successfully', $ans)`
     *
     * @param integer $num
     *
     * @return $this
     */
    public function sumUp($num=0)
    {
        if (!$this->execOrNot) {
                return $this;
        }

        $this->results = array_sum(func_get_args());
        return $this;
    }    

    /**
     * subtract a bunch of numbers. eg: `->beforeQuerying()->subtract(3,4,5,6,7)->storeAs($ans)->stopAndOutput(1001,'got answer successfully', $ans)` also `->beforeQuerying()->from(5)->subtract(3)->storeAs($ans)->stopAndOutput(1001,'got answer successfully', $ans)`
     *
     * @return $this
     */
    public function subtract()
    {
        if (!$this->execOrNot) {
            return $this;
        }

        if(count(func_get_args()) == 1) {
             $this->results = ($this->results - func_get_args()[0]);
        } else {
            foreach (func_get_args() as $key => $number) {
                $total = ($key == 0)? $number : $total - $number;
            }
            $this->results = $total;
        }
        return $this;
    }

    /**
     * find the product of numbers.eg: `->beforeQuerying()->multiply(3,4,5,6,7)->storeAs($ans)->stopAndOutput(1001,'got answer successfully', $ans)`
     *
     * @return $this
     */
    public function multiply()
    {
        if (!$this->execOrNot) {
            return $this;
        }
        $this->results = array_product(func_get_args());
        return $this;

    } 

    /**
     * divide a range of numbers.eg: `->beforeQuerying()->divide(6,2)->storeAs($ans)->stopAndOutput(1001,'got answer successfully', $ans)`
     *
     * @return $this
     */
    public function divide()
    {
        if (!$this->execOrNot) {
            return $this;
        }
        
        if(count(func_get_args()) < 2) {
            $this->results = 0;
            return $this;
        } else {
            foreach (func_get_args() as $key => $number) {
                $total = ($key == 0)? $number : $total / $number;
            }
            $this->results = $total;
        }
        $this->cleanOutput();
        return $this;
    }    

    /**
     * This picks results from your earlier computation and divides it by a given number. eg: `->beforeQuerying()->sumUp(3,4,5,6,7)->divdeBy(6)->storeAs($ans)->stopAndOutput(1001,'got answer successfully', $ans)`
     *
     * @param  $number 
     * @return $this
     */
    public function divideBy($number)
    {
        if (!$this->execOrNot) {
            return $this;
        }
        
        $this->results = ($this->results)/$number;
        $this->cleanOutput();
        return $this;
    }
    /**
     * Find the square root of a number. eg:`->beforeQuerying()->findSquareRoot($number)->storeAs($input_root)`
     *
     * @param integer $num
     *
     * @return $this
     */
    public function findSquareRootOf($number)
    {
        if(!$this->execOrNot) {
            return $this;
        }
        $this->results = sqrt($number);
        $this->cleanOutput();
        return $this;
    }

    /**
     * Get the squareRoot of the result of the preceeding computation eg: `->beforeQuerying()->divide(20, 40)->getSquareRoot()->storeAs($output)->succeedWith($output)`
     * return $this
     */
    public function getSquareRoot()
    {
        if(!$this->execOrNot) {
            return $this;
        }
        $this->results = sqrt($this->results);
        $this->cleanOutput();
        return $this;
    }
    /**
     * round up a number.eg: `->beforeCreating()->roundUp($input_milage, 1)->storeAs($input_milage)`
     *
     * @param  integer $number
     * @param  integer $precision
     * @return $this
     */
    public function roundUp($number, $precision=1)
    {
        if(!$this->execOrNot) {
            return $this;
        } 
        $this->results = round($number, $precision);
        $this->cleanOutput();
        return $this;
    }

    /**
     * Find the percent of a number eg: `->beforeQuerying()->find(10)->percentOf(200)->storeAs($input_discount)`
     * @param $number
     * @return $this
     */
    public function percentOf($number)
    {
        if(!$this->execOrNot) {
            return $this;
        }
        $percentage = ($this->results/100);
        $this->results = $percentage*($number);
        $this->cleanOutput();
        return $this;
    }
}
