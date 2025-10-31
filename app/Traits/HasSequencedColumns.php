<?php

namespace App\Traits;

use App\Models\Sequence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use InvalidArgumentException;

trait HasSequencedColumns
{
    public static function bootHasSequencedColumns(): void
    {
        static::creating(function (Model $entity) {
            $defaultColumn = static::getDefaultSequenceColumn();
            $shouldSetDefaultColumn = $entity->autoSetDefaultSequenceColumn($entity);

            if (! $entity->hasAttribute($defaultColumn) && $shouldSetDefaultColumn) {
                $entity->setAttribute($defaultColumn, $entity->nextSequence());
            }
        });

        static::created(function (Model $entity) {
            foreach (static::getSequenceColumns() as $column) {
                Sequence::incrementOrCreate([
                    'sequencable_type' => $entity->getMorphClass(),
                    'column'           => $column,
                ], 'last');
            }
        });
    }

    public static function nextSequence(?string $column = null): string
    {
        $column ??= static::getDefaultSequenceColumn();

        if (! in_array($column, static::getSequenceColumns())) {
            throw new InvalidArgumentException(
                "the provided column: {$column} doesn't exist in the getSequenceColumns() method returned array"
            );
        }

        $last = Sequence::query()
            ->where('sequencable_type', app(static::class)->getMorphClass())
            ->where('column', $column)
            ->value('last');

        $sequence = str($last + 1)->padLeft(5, '0');

        return str(static::getSequencePrefix())
            ->append('-')
            ->append($sequence);
    }

    public function sequences(): HasMany
    {
        return $this
            ->hasMany(Sequence::class)
            ->where('sequencable_type', $this->getMorphClass());
    }

    public static function getDefaultSequenceColumn(): string
    {
        return static::getSequenceColumns()[0];
    }

    public function autoSetDefaultSequenceColumn(Model $entity): bool
    {
        return true;
    }

    abstract public static function getSequenceColumns(): array;

    abstract public static function getSequencePrefix(): string;
}
