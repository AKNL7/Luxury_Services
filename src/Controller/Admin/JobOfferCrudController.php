<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('reference'),
            TextField::new('title'),
            TextEditorField::new('descriptionOffer'),
            TextField::new('jobLocation'), 
            IntegerField::new('salary'),
            DateTimeField::new('closingAt'), 
            AssociationField::new('client'), 
            AssociationField::new('category'), 
            AssociationField::new('type'), 
            TextEditorField::new('notes'),

    
        ];
    }
    
}
