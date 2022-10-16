<?php

namespace App\Service;

use Symfony\Component\Finder\Finder;

class File
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}

class Directory
{
    /**
     * @param string $name
     * @param (File|Directory)[] $children
     */
    public function __construct(
        public readonly string $name,
        public readonly array $children,
    ) {
    }
}

class VisitFiles
{
    /**
     * Traverse Files & Directories.
     *
     * Return a list of every files filtered by given function.
     *
     * @param string $root
     * @param callable $filterFn
     *
     * @return array
     */
    public function visitFiles(string $root, callable $filterFn): array
    {
        $finder = new Finder();
        $files = [];

        foreach ($finder->in($root)->files() as $file) {
            $file = (object) [
                'name' => $file->getFilename(),
                'path' => $file->getPathname(),
            ];
            if ($filterFn($file)) {
                $files[] = $file;
            }
        }

        return $files;
    }

    public function usageExemple(): void
    {
        $files = $this->visitFiles(
            __DIR__,
            function ($file) {
                $name = $file->name;
                for ($i = 0; $i < floor(strlen($name)); $i++) {
                    if ($name[$i] != $name[strlen($name) - $i - 1]) {
                        return false;
                    }
                }
                return true;
            }
        );
    }
}
