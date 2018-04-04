<?php

class HeadingConverter extends BaseConverter implements ConverterInterface
{
    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

        // remove the h2 tags from the text. We just need the inner text.
        $html = preg_replace('/<(\/|)h2>/i', '', $html);

        return array(
            'type' => 'heading',
            'data' => array(
                'text' => ' ' . $this->htmlToMarkdown($html)
            )
        );
    }

    public function toHtml(array $data)
    {
        if(!isset($data['heading'])){
            $heading = "h2";
        }else{
            $heading = $data['heading'];
        }
        return "<".$heading.">".stripslashes($data['text']) . "</".$heading.">";
    }
}
