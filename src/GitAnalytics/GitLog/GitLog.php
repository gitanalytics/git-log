<?php

namespace GitAnalytics\GitLog;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ProcessBuilder;

class GitLog {

    protected $processBuilder;

    public function __construct($arguments = null)
    {
        $builder = new ProcessBuilder();

        $builder = $builder->setPrefix('/usr/bin/git')
            ->add('log');

        if (count($arguments) > 0) {
            $builder = $this->addBuilderArguments($builder, $arguments);
        }

        $this->processBuilder = $builder->getProcess();
    }

    /**
     * Add arguments from service configuration
     *
     * @author Diego Nobre <dcnobre@gmail.com>
     * @since 2015-12-14
     *
     * @param ProcessBuilder $builder
     * @param $arguments
     * @return ProcessBuilder
     */
    public function addBuilderArguments(ProcessBuilder $builder, $arguments)
    {
        if (count($arguments) > 0) {
            foreach ($arguments as $arg) :
                $builder->add($arg);
            endforeach;
        }

        return $builder;
    }

    /**
     * Return git log in array format
     *
     * @author Diego Nobre <dcnobre@gmail.com>
     * @since 2015-12-14
     *
     * @return array
     */
    public function getLog()
    {
        $this->processBuilder->run();

        if (!$this->processBuilder->isSuccessful()) {
            throw new ProcessFailedException($this->processBuilder);
        }

        return array_filter(explode("\n", $this->processBuilder->getOutput()));
    }
}
