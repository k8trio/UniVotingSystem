<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSqliteData extends Command
{
    protected $signature = 'import:sqlite';
    protected $description = 'Import SQLite data into MySQL';

    public function handle()
    {
        $sqlitePath = database_path('database.sqlite');

        if (!file_exists($sqlitePath)) {
            $this->error('SQLite file not found at: ' . $sqlitePath);
            return;
        }

        $sqlite = new \PDO('sqlite:' . $sqlitePath);
        $sqlite->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Users
        $this->info('Importing users...');
        DB::table('users')->truncate();
        $rows = $sqlite->query('SELECT * FROM users')->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            DB::table('users')->insert($row);
        }
        $this->info(count($rows) . ' users imported.');

        // Positions
        $this->info('Importing positions...');
        DB::table('positions')->truncate();
        $rows = $sqlite->query('SELECT * FROM positions')->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            DB::table('positions')->insert($row);
        }
        $this->info(count($rows) . ' positions imported.');

        // Candidates
        $this->info('Importing candidates...');
        DB::table('candidates')->truncate();
        $rows = $sqlite->query('SELECT * FROM candidates')->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            DB::table('candidates')->insert($row);
        }
        $this->info(count($rows) . ' candidates imported.');

        // Votes
        $this->info('Importing votes...');
        DB::table('votes')->truncate();
        $rows = $sqlite->query('SELECT * FROM votes')->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            DB::table('votes')->insert($row);
        }
        $this->info(count($rows) . ' votes imported.');

        $this->info('✅ All data imported successfully!');
    }
}