<?php

namespace App\Controller\Admin;

use App\Entity\Discount;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class DiscountCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Discount::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('name'),
            TextField::new('description'),
            DateField::new('startDate'),
            DateField::new('endDate'),
            NumberField::new('percentageDiscount'),
            NumberField::new('amountDiscount'),
            BooleanField::new('active'),
            IntegerField::new('priority'),
            AssociationField::new('category')->autocomplete(),

        ];
    }
    
}
