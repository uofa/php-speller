<?php
/**
 * PHP Speller.
 *
 * @copyright 2015, Михаил Красильников <m.krasilnikov@yandex.ru>
 * @author    Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license   http://opensource.org/licenses/MIT MIT
 */

namespace Mekras\Speller\Source;

use Mekras\Speller\Exception\SourceException;

/**
 * File as text source.
 *
 * @since x.x Implements EncodingAwareSource.
 * @since 1.2
 */
class FileSource implements EncodingAwareSource
{
    /**
     * File name.
     *
     * @var string
     * @since 1.2
     */
    protected $filename;

    /**
     * Text encoding.
     *
     * @var string
     */
    private $encoding;

    /**
     * Create new source.
     *
     * @param string $filename
     * @param string $encoding File encoding (default to "UTF-8").
     *
     * @since x.x New argument — $encoding.
     * @since 1.2
     */
    public function __construct($filename, $encoding = 'UTF-8')
    {
        $this->filename = $filename;
        $this->encoding = (string) $encoding;
    }

    /**
     * Return text as one string
     *
     * @return string
     *
     * @throws SourceException Fail to read from text source.
     *
     * @since x.x Throws {@see SourceException}.
     * @since 1.2
     */
    public function getAsString()
    {
        if (!file_exists($this->filename)) {
            throw new SourceException(sprintf('File "%s" not exists', $this->filename));
        }

        if (!is_readable($this->filename)) {
            throw new SourceException(sprintf('File "%s" is not readable', $this->filename));
        }

        return file_get_contents($this->filename);
    }

    /**
     * Return source text encoding.
     *
     * @return string
     *
     * @since x.x
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Return file name with text to check.
     *
     * This can be used by backends with file checking support.
     *
     * @return string
     *
     * @since 1.2
     */
    public function getFilename()
    {
        return (string) $this->filename;
    }
}
