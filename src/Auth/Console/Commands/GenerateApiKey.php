<?php namespace Sujit\Api\Auth\Console\Commands;

/**
 * File GenerateApiKeys.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Auth\Console\Commands
 * @subpackage GenerateApiKeys.php
 * @author     Sujit Baniya <sujit@kvsocial.com>
 * @copyright  2018 Instasuite.com. All rights reserved.
 */

use Illuminate\Console\Command;
use Sujit\Api\Auth\Models\ApiKey;

/**
 * Class GenerateApiKeys
 *
 * @package   Sujit\Api\Auth\Console\Commands;
 * @subpackage GenerateApiKeys
 * @author     Sujit Baniya <sujit@kvsocial.com>
 */
class GenerateApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-key:generate
                            {--id= : ID of the model you want to bind to this API key}
                            {--type= : The class name of the model you want to bind to this API key}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an API key';
    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $apiKeyableId = $this->option('id');
        $apiKeyableType = $this->option('type');
        $apiKey = new ApiKey([
            'key'             => ApiKey::generateKey(),
            'apikeyable_id'   => $apiKeyableId,
            'apikeyable_type' => $apiKeyableType,
        ]);
        $apiKey->save();
        $this->info('An API key was created with the following key: ' . $apiKey->key);
        return;
    }
}