<?php

// start session
session_start();

// import all the required files
require "includes/functions.php";

/*
    simple routing system -> decide what page to load depending the url the user visit

    localhost:9000/ -> home.php
    localhost:9000/login -> login.php
    localhost:9000/signup -> signup.php
    localhost:9000/logout -> logout.php
  */

  // figure out the url the user is visiting
  $path = $_SERVER["REQUEST_URI"];

  // once you figure out the path the user is visiting, load relevant content
  switch ( $path ){
    //actions
    case '/auth/login':
      require 'includes/auth/login.php';
      break;
    case '/auth/signup':
      require 'includes/auth/signup.php';
      break;
    case '/task/add':
      require 'includes/task/add.php';
      break;
    case '/task/update':
      require 'includes/task/update.php';
      break;
    case '/task/delete':
      require 'includes/task/delete.php';
      break;
    //pages
    case '/login':
      require 'pages/login.php';
      break;
    case '/signup':
      require 'pages/signup.php';
      break;
    case '/logout':
      require 'pages/logout.php';
      break;
    default:
      require 'pages/home.php';
      break;
  }