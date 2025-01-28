<?php

function ValidateText($var,$fieldName,&$err,&$valid)
{
    if(empty($var))
    {
        $valid = false;
        $err .="Missing ".$fieldName." <br>"; 
    }
}

function ValidateIntRange($var,$fieldName,&$err,&$valid,$start,$end)
{
    if($var ==NULL)
    {
        $valid = false;
        $err .=$fieldName." must be a whole number between ".$start." and ".$end." <br>"; 
    }
    else if (($var<$start) ||($var>$end))
    {
        $valid = false;
        $err .=$fieldName." must be a whole number between ".$start." and ".$end." <br>"; 
    }
}

function validateRequired($val,$fieldName,&$err,&$valid)
{
    if ($val==null)
    {
       $valid = false;
       $err .=$fieldName." is required <br>"; 
       
    }
}