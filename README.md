<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#What-does-the-application-do">What does the application do?</a></ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#requirements ">Requirements</a></li>
        <li><a href="#installation ">Installation</a></li>
      </ul>
    </li>
    <li>
        <a href="#usage"> Usage</a>
        <ul>
            <li><a target="_blank" href="#the-most-important-things-are">The most important things are</a></li>
            <li><a target="_blank" href="#notes ">Notes</a></li>
            <li><a target="_blank" href="#db-design ">DB Design</a></li>
        </ul>
    </li>
    <li>
        <a target="_blank" href="#test-report">Test report</a>
    </li>
    <li>
        <a target="_blank" href="#api">API</a>
    </li>
      </ol>
</details>


## What does the application do?

CMS application management the content of your website,
like articles, pages, photos, users ans website settings, etc... 

## Getting Started
To start with project you must have next requirements

### Requirements 
* PHP version: 7.2.5 at least 
* Laravel framework version: 7.0
* Server type: Mysql 
* Mysql version: 8.0.18

### Installation
* To install project follow next steps.
    
    1- Install composer.
    
        composer install 
   
    2- Create .env file.
    
        cp .env.example .env 
    
    3- Make your DB, and set the configuration in the env file.
    
    4- Generate key for application.
    
        php artisan key:generate 
    
    5- Migrate Database.
    
        php artisan migrate 
        
    6- Seed database.
   
        php artisan db:seed
  
## Usage

   1- The most important things are: [Read this](IMPORTANT.md)
   
   2- Notes: [Read this](NOTES.md)
   
   2- DB Design: [Read this](db_design.pdf)
   
   
## Test report
* To view test report: [Read this](TEST.md)

## Api
* To view API: [Read this](API.md)
