<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Entity\Page;
use App\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fieldsConfig = [
            'value' => [
                'field_type' => TextareaType::class,
                'required' => true,
            ],
        ];

        return [
            TextField::new('page')
                ->setFormType(EntityType::class)
                ->setFormTypeOption('class', Page::class)
                ->hideOnIndex(),
            TextField::new('name'),
            TranslationField::new('translations', 'value', $fieldsConfig)
                ->setRequired(true)
                ->hideOnIndex(),
        ];
    }
}
