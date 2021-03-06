<?php

namespace Nuwave\Lighthouse\Events;

use GraphQL\Language\AST\DocumentNode;
use Illuminate\Support\Carbon;

/**
 * Fires right before resolving an individual query.
 *
 * Might happen multiple times in a single request if query batching is used.
 */
class StartExecution
{
    /**
     * The client given parsed query string.
     *
     * @var \GraphQL\Language\AST\DocumentNode
     */
    public $query;

    /**
     * The client given variables, neither validated nor transformed.
     *
     * @var array<string, mixed>|null
     */
    public $variables;

    /**
     * The client given operation name.
     *
     * @var string|null
     */
    public $operationName;

    /**
     * The point in time when the query execution started.
     *
     * @var \Illuminate\Support\Carbon
     */
    public $moment;

    /**
     * @param array<string, mixed>|null $variables
     */
    public function __construct(DocumentNode $query, ?array $variables, ?string $operationName)
    {
        $this->query = $query;
        $this->variables = $variables;
        $this->operationName = $operationName;
        $this->moment = Carbon::now();
    }
}
