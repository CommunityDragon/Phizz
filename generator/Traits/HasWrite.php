<?php

namespace Phizz\Generator\Traits;

use Nette\PhpGenerator\PhpFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

trait HasWrite
{
    public function imports(): array
    {
        return [];
    }

    public function filename(): string
    {
        return $this->definition()->getName();
    }

    public function path(): string
    {
        return Path::join($this->directory(), $this->filename().'.php');
    }

    public function write(): void
    {
        $file = new PhpFile;

        $namespace = $file->addNamespace($this->namespace());

        foreach ($this->imports() as $import) {
            $namespace->addUse($import);
        }

        /** @noinspection PhpInternalEntityUsedInspection */
        $namespace->add($this->definition()->setNamespace($namespace));

        $filesystem = new Filesystem;

        if (! is_dir($this->directory())) {
            $filesystem->mkdir($this->directory(), 0755);
        }

        $filesystem->dumpFile($this->path(), $file);
    }
}
