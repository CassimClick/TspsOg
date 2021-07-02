<?=$this->extend('layouts/coreLayout') ?>
<?=$this->section('content') ?>
<?=$this->include('components/slider') ?>
<?=$this->include('components/schoolLevels') ?>
<?=$this->include('components/whyChooseUs') ?>
<?=$this->include('components/announcement') ?>
<?=$this->include('components/eventsModule') ?>
<?php echo $this->include('components/team')   ?>


<?=$this->include('components/gallery') ?>
<?=$this->include('components/feedback') ?>
<?=$this->endSection() ?>