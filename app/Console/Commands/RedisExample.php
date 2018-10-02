<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisExample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:RedisExample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command demonstrating how to use Redis as a caching data structure';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $this->info('starting...');

        // Establishes a connection our redis server
        $redis = Redis::connection();

        // Flush DB(0)
        $redis->flushdb();

        // Inserts a key value pair into default redis db (0)
        $redis->set('test_key', 'value');

        // Specifies which redis db we want to insert into (0-15)
        $redis->select(2);

        // Flush DB(2)
        $redis->flushdb();

        // Insert some keys into redis
        for ($i = 0; $i < 3; $i++) {
            $value = 'value: '.$i;
            $redis->set('test_folder:test_sub_folder:key_'.$i, $value); // note ':' delimiter
        }

        // Insert some JSON into redis db(2)
        $redis->set('fake_project_id:fake_layer_id:fake_vector_id', '[
            {
              "_id": "5bb3e6751acf7f5a61483a5f",
              "index": 0,
              "guid": "039d43d9-92af-4060-bd7f-3c5ed05eebfd",
              "isActive": false,
              "balance": "$1,295.57",
              "picture": "http://placehold.it/32x32",
              "age": 34,
              "eyeColor": "green",
              "name": "Dickson Matthews",
              "gender": "male",
              "company": "KONGLE",
              "email": "dicksonmatthews@kongle.com",
              "phone": "+1 (874) 578-2929",
              "address": "215 Glenwood Road, Waterford, Texas, 9595",
              "about": "Do tempor laborum quis reprehenderit cupidatat mollit occaecat. Consectetur cupidatat sit amet qui ullamco esse sunt sit pariatur. Consectetur anim in amet nostrud incididunt ut ea irure laborum elit.\r\n",
              "registered": "2017-08-09T09:27:24 +07:00",
              "latitude": 67.251575,
              "longitude": 167.340152,
              "tags": [
                "officia",
                "sunt",
                "sint",
                "amet",
                "pariatur",
                "in",
                "commodo"
              ],
              "friends": [
                {
                  "id": 0,
                  "name": "Miranda Hawkins"
                },
                {
                  "id": 1,
                  "name": "Silva Dickerson"
                },
                {
                  "id": 2,
                  "name": "Joni Kim"
                }
              ],
              "greeting": "Hello, Dickson Matthews! You have 8 unread messages.",
              "favoriteFruit": "strawberry"
            }
        ]');

        $keys = [];

        // Example retrieving keys from redis
        $rawResults = $redis->scan(0, 'match', 'fake_project_id:*');

        $keys = array_merge($keys, $rawResults[1]); // Get all keys that match pattern 'fake_project_id:*'

        foreach ($keys as $key) {
            $results = json_decode($redis->get($key)); // Retrieve value from key and convert from JSON to array
            var_dump($results[0]->tags); // Get one attribute of resulting array (pretend this is vector points/images)
        }

        $this->info('redis example worked');
    }
}
