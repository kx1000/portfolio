<?php


namespace App\Field;


use App\Entity\File;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Vich\UploaderBundle\Form\Type\VichFileType;

class VichFileField
{
    use FieldTrait;

    private static $basePath;

    public static function new(string $fileProperty, string $fileNameProperty, ?string $label = null): self
    {
        return (new self())
            ->formatValue(function ($value, File $entity) use ($fileNameProperty) {
                return
                    self::$basePath . PropertyAccess::createPropertyAccessor()->getValue($entity, $fileNameProperty);
            })
            ->setProperty($fileProperty)
            ->setLabel($label)
            ->setTemplatePath('admin/fields/vich_file.html.twig')
            ->setFormType(VichFileType::class)
            ->setFormTypeOptions([
                'required' => true,
                'allow_delete' => false,
            ])
            ->addCssClass('field-image')
            ->setTextAlign('center')
            ;
    }

    public function setBasePath(string $basePath): self
    {
        self::$basePath = $basePath;

        return $this;
    }
}