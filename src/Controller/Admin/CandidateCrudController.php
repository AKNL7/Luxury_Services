<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidate::class;
    }



    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('firstName'),
            TextField::new('lastName'),
            AssociationField::new('user'),
            TextField::new('adress'),
            CountryField::new('country'),
            TextField::new('nationality'),
            TextField::new('currentLocation'),
            TextField::new('placeOfBirth'),
            DateTimeField::new('birthAt'),
            DateTimeField::new('createdAt'),
            DateTimeField::new('updatedAt'),
            IntegerField::new('passport'),
            AssociationField::new('passport'),
            AssociationField::new('curriculumVitae'),
            AssociationField::new('profilPicture'),
            AssociationField::new('category'),
            AssociationField::new('experience'),
            AssociationField::new('gender'),
            TextEditorField::new('description'),



        ];
    }
}
