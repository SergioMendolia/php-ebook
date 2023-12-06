<?php

namespace Kiwilan\Ebook\Formats;

use Kiwilan\Ebook\Formats\Audio\AudiobookModule;
use Kiwilan\Ebook\Formats\Cba\CbaModule;
use Kiwilan\Ebook\Formats\Djvu\DjvuModule;
use Kiwilan\Ebook\Formats\Epub\EpubModule;
use Kiwilan\Ebook\Formats\Fb2\Fb2Module;
use Kiwilan\Ebook\Formats\Mobi\MobiModule;
use Kiwilan\Ebook\Formats\Pdf\PdfModule;

class EbookParser
{
    protected function __construct(
        protected EbookModule $module,
        protected ?AudiobookModule $audiobook = null,
        protected ?CbaModule $cba = null,
        protected ?DjvuModule $djvu = null,
        protected ?EpubModule $epub = null,
        protected ?MobiModule $mobi = null,
        protected ?Fb2Module $fb2 = null,
        protected ?PdfModule $pdf = null,
        protected ?string $type = null,
    ) {
    }

    public static function make(EbookModule $module): self
    {
        $self = new self($module);

        if ($module instanceof AudiobookModule) {
            $self->audiobook = $module;
            $self->type = 'audiobook';
        }

        if ($module instanceof CbaModule) {
            $self->cba = $module;
            $self->type = 'cba';
        }

        if ($module instanceof DjvuModule) {
            $self->djvu = $module;
            $self->type = 'djvu';
        }

        if ($module instanceof EpubModule) {
            $self->epub = $module;
            $self->type = 'epub';
        }

        if ($module instanceof MobiModule) {
            $self->mobi = $module;
            $self->type = 'mobi';
        }

        if ($module instanceof Fb2Module) {
            $self->fb2 = $module;
            $self->type = 'fb2';
        }

        if ($module instanceof PdfModule) {
            $self->pdf = $module;
            $self->type = 'pdf';
        }

        return $self;
    }

    public function getModule(): EbookModule
    {
        return $this->module;
    }

    public function getAudiobook(): ?AudiobookModule
    {
        return $this->audiobook;
    }

    public function getCba(): ?CbaModule
    {
        return $this->cba;
    }

    public function getDjvu(): ?DjvuModule
    {
        return $this->djvu;
    }

    public function getEpub(): ?EpubModule
    {
        return $this->epub;
    }

    public function getFb2(): ?Fb2Module
    {
        return $this->fb2;
    }

    public function getMobi(): ?MobiModule
    {
        return $this->mobi;
    }

    public function getPdf(): ?PdfModule
    {
        return $this->pdf;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isDjvu(): bool
    {
        return $this->djvu !== null;
    }

    public function isEpub(): bool
    {
        return $this->epub !== null;
    }

    public function isMobi(): bool
    {
        return $this->mobi !== null;
    }

    public function isCba(): bool
    {
        return $this->cba !== null;
    }

    public function isFb2(): bool
    {
        return $this->fb2 !== null;
    }

    public function isPdf(): bool
    {
        return $this->pdf !== null;
    }

    public function isAudiobook(): bool
    {
        return $this->audiobook !== null;
    }

    public function toArray(): array
    {
        return [
            'epub' => $this->epub?->toArray(),
            'fb2' => $this->fb2?->toArray(),
            'djvu' => $this->djvu?->toArray(),
            'mobi' => $this->mobi?->toArray(),
            'cba' => $this->cba?->toArray(),
            'pdf' => $this->pdf?->toArray(),
            'audiobook' => $this->audiobook?->toArray(),
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
