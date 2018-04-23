<?php

namespace App\Console\Commands;

use App\Services\Category\PrepareDataForPrintingService;
use Illuminate\Console\Command;

class DisplayCategoryTreeCommand extends Command
{
    private $prepareDataForPrintingService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'display:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays categories formatted in tree';

    /**
     * Create a new command instance.
     *
     * @param PrepareDataForPrintingService $prepareDataForPrintingService
     *
     * @return void
     */
    public function __construct(PrepareDataForPrintingService $prepareDataForPrintingService)
    {
        parent::__construct();
        $this->prepareDataForPrintingService = $prepareDataForPrintingService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->runCommand();
    }

    private function runCommand()
    {
        $this->output->writeln('Starting...');

        $recursiveSolution = $this->prepareDataForPrintingService->getRecursiveSolution();
        $iterativeSolution = $this->prepareDataForPrintingService->getIterativeSolution();

        $this->output->writeln('Iterative solution:');
        $this->printArrayToConsole($iterativeSolution);

        $this->output->writeln('Recursive solution:');
        $this->printArrayToConsole($recursiveSolution);

        $this->output->writeln('Goodbye!');
    }

    private function printArrayToConsole($array)
    {
        foreach ($array as $element) {
            $offset = substr_count($element, '.');
            $this->output->writeln(str_repeat('-', $offset) . $element);
        }
    }

}
