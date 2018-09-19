<?php
declare(strict_types=1);

namespace Jack\Symfony;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\PhpProcess;
use Symfony\Component\Process\Process;

final class ProcessManagerTest extends TestCase
{
    /**
     * @var ProcessManager
     */
    protected $processManager;

    public function setUp()
    {
        $this->processManager = new ProcessManager();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRunParallelWithZeroProcesses()
    {
        $this->processManager->runParallel([], 0);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRunParallelWithNonSymfonyProcess()
    {
        $this->processManager->runParallel(['ls -la'], 0);
    }

    public function testRunParallel()
    {
        $processes = [
            new Process('echo foo'),
            new Process('echo bar'),
            new PhpProcess('<?php echo \'Hello World\'; ?>'),
        ];
        $this->processManager->runParallel($processes, 2, 1000);

        $this->assertEquals('foo' . PHP_EOL, $processes[0]->getOutput());
        $this->assertEquals('bar' . PHP_EOL, $processes[1]->getOutput());
        $this->assertEquals('Hello World', $processes[2]->getOutput());
    }
}
