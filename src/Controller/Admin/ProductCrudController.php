<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\Type\ProductImageType;
use App\Form\Type\ProductInformationType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('name'),
            CollectionField::new('productImages')
            ->setEntryType(ProductImageType::class),
            TextField::new('description'),
            // MoneyField::new('unitPrice')->setCurrency('EUR'),
            MoneyField::new('unitPrice')->setCustomOption('storedAsCents', false)->setNumDecimals(0)->setCurrency('EUR'),
            // MoneyField::new('unitPrice')->setCurrency('EUR')->setFormTypeOptions([
            //     'divisor' => 100
            // ]),
            IntegerField::new('stock'),
            CollectionField::new('information')
            ->setEntryType(ProductInformationType::class)
            ->setLabel('Information Product (JSON)'),
            
            AssociationField::new('category')->autocomplete(),
        ];
    }
    
}
