<?php
/* (c) Anton Medvedev <anton@medv.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Console\Output;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OutputWatcher implements OutputInterface
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var bool
     */
    private $wasWritten = false;

    /**
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * {@inheritdoc}
     */
    public function write($messages, $newline = false, $type = self::OUTPUT_NORMAL): void
    {
        $this->wasWritten = true;
        $this->output->write($messages, $newline, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function writeln($messages, $type = self::OUTPUT_NORMAL): void
    {
        $this->write($messages, true, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function setVerbosity($level): void
    {
        $this->output->setVerbosity($level);
    }

    /**
     * {@inheritdoc}
     */
    public function getVerbosity(): int
    {
        return $this->output->getVerbosity();
    }

    /**
     * {@inheritdoc}
     */
    public function setDecorated($decorated): void
    {
        $this->output->setDecorated($decorated);
    }

    /**
     * {@inheritdoc}
     */
    public function isDecorated(): bool
    {
        return $this->output->isDecorated();
    }

    /**
     * {@inheritdoc}
     */
    public function setFormatter(OutputFormatterInterface $formatter): void
    {
        $this->output->setFormatter($formatter);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormatter(): OutputFormatterInterface
    {
        return $this->output->getFormatter();
    }

    /**
     * @param boolean $wasWritten
     */
    public function setWasWritten($wasWritten)
    {
        $this->wasWritten = $wasWritten;
    }

    /**
     * @return boolean
     */
    public function getWasWritten()
    {
        return $this->wasWritten;
    }

    /**
     * {@inheritdoc}
     */
    public function isQuiet(): bool
    {
        return self::VERBOSITY_QUIET === $this->getVerbosity();
    }

    /**
     * {@inheritdoc}
     */
    public function isVerbose(): bool
    {
        return self::VERBOSITY_VERBOSE <= $this->getVerbosity();
    }

    /**
     * {@inheritdoc}
     */
    public function isVeryVerbose(): bool
    {
        return self::VERBOSITY_VERY_VERBOSE <= $this->getVerbosity();
    }

    /**
     * {@inheritdoc}
     */
    public function isDebug(): bool
    {
        return self::VERBOSITY_DEBUG <= $this->getVerbosity();
    }
}
