<?php


class Block
{
    /**
     * @var Header
     */
    public $header;

    /**
     * @var int
     */
    public $transactionsCount = 0;

    /**
     * @var array
     */
    public $transactions = [];

    /**
     * @param Reader $stream
     * @return Block
     */
    static public function parse(Reader $stream): self
    {
        $block = new static;
        $block->header = Header::parse($stream);
        $block->transactionsCount = $stream->readCompactSize();

        for ($i = 0; $i < $block->transactionsCount; $i++) {
            $block->transactions[] = Transaction::parse($stream);
        }

        return $block;
    }

}