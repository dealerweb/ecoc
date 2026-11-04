<?php

declare(strict_types=1);

namespace Dealerweb\ECoc;

/**
 * One element of the data set.
 *
 * @internal
 */
final class Node
{
    /**
     * @param string $name the name of the element, without a namespace prefix
     * @param string $value the text of an element without children
     * @param list<Node> $children
     */
    public function __construct(
        public readonly string $name,
        public readonly string $value = '',
        public readonly array $children = [],
    ) {}

    public function isLeaf(): bool
    {
        return $this->children === [];
    }

    /**
     * Every element below this one with one of the names: the nearest first, in the order of the document within a
     * level. So a field of the vehicle wins over an element of the same name in a table further down.
     *
     * @return list<Node>
     */
    public function find(string ...$names): array
    {
        $found = [];
        $level = $this->children;
        while ($level !== []) {
            $next = [];
            foreach ($level as $node) {
                if (in_array($node->name, $names, true)) {
                    $found[] = $node;
                }
                array_push($next, ...$node->children);
            }
            $level = $next;
        }

        return $found;
    }

    /**
     * The first element with one of the names that has a value.
     */
    public function first(string ...$names): ?Node
    {
        foreach ($this->find(...$names) as $node) {
            if ($node->isLeaf() && $node->value !== '') {
                return $node;
            }
        }

        return null;
    }

    /**
     * Every element without children below this one, in the order of the document.
     *
     * @return list<Node>
     */
    public function leaves(): array
    {
        $leaves = [];
        foreach ($this->children as $child) {
            if ($child->isLeaf()) {
                $leaves[] = $child;
            } else {
                array_push($leaves, ...$child->leaves());
            }
        }

        return $leaves;
    }
}
