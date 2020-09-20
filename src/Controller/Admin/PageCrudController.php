<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\ContentType;
use App\Form\LinkType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            CollectionField::new('contents')
                ->setEntryType(ContentType::class)
                ->setFormTypeOption('by_reference', false),
        ];
    }
}
