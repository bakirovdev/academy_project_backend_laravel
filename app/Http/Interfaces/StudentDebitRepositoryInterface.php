<?php

namespace App\Http\Interfaces;

interface StudentDebitRepositoryInterface {
  function getStudents($request);
  function payment($request);
}
