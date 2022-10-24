<?php

namespace App\Http\Interfaces;

interface GroupRepositoryInterface {
  function getAllGroup();
  function createGroup($request);
  function updateGroup($id, $request);
  function getAuthGroup();
  function findGroup($id);
}
