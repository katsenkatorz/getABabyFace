<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MediaType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('imageFile', VichImageType::class, array(
			'required'      => false,
			'allow_delete'  => false,
			'download_link' => false,
		));
	}

	/**
	 * {@inheritdoc}
	 * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => 'AdminBundle\Entity\Media']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'adminbundle_media';
	}


}
