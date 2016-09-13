<?php

namespace SmartCAT\API\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;
class DocumentModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'SmartCAT\\API\\Model\\DocumentModel') {
            return false;
        }
        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \SmartCAT\API\Model\DocumentModel) {
            return true;
        }
        return false;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (empty($data)) {
            return null;
        }
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \SmartCAT\API\Model\DocumentModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'id')) {
            $object->setId($data->{'id'});
        }
        if (property_exists($data, 'name')) {
            $object->setName($data->{'name'});
        }
        if (property_exists($data, 'creationDate')) {
            $object->setCreationDate(new \DateTime($data->{'creationDate'}));
        }
        if (property_exists($data, 'deadline')) {
            $object->setDeadline(new \DateTime($data->{'deadline'}));
        }
        if (property_exists($data, 'sourceLanguage')) {
            $object->setSourceLanguage($data->{'sourceLanguage'});
        }
        if (property_exists($data, 'documentDisassemblingStatus')) {
            $object->setDocumentDisassemblingStatus($data->{'documentDisassemblingStatus'});
        }
        if (property_exists($data, 'targetLanguage')) {
            $object->setTargetLanguage($data->{'targetLanguage'});
        }
        if (property_exists($data, 'status')) {
            $object->setStatus($data->{'status'});
        }
        if (property_exists($data, 'wordsCount')) {
            $object->setWordsCount($data->{'wordsCount'});
        }
        if (property_exists($data, 'statusModificationDate')) {
            $object->setStatusModificationDate(new \DateTime($data->{'statusModificationDate'}));
        }
        if (property_exists($data, 'pretranslateCompleted')) {
            $object->setPretranslateCompleted($data->{'pretranslateCompleted'});
        }
        if (property_exists($data, 'workflowStages')) {
            $values = array();
            foreach ($data->{'workflowStages'} as $value) {
                $values[] = $this->serializer->deserialize($value, 'SmartCAT\\API\\Model\\DocumentWorkflowStageModel', 'raw', $context);
            }
            $object->setWorkflowStages($values);
        }
        if (property_exists($data, 'externalId')) {
            $object->setExternalId($data->{'externalId'});
        }
        if (property_exists($data, 'metaInfo')) {
            $object->setMetaInfo($data->{'metaInfo'});
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getId()) {
            $data->{'id'} = $object->getId();
        }
        if (null !== $object->getName()) {
            $data->{'name'} = $object->getName();
        }
        if (null !== $object->getCreationDate()) {
            $data->{'creationDate'} = $object->getCreationDate()->format("Y-m-d\TH:i:sP");
        }
        if (null !== $object->getDeadline()) {
            $data->{'deadline'} = $object->getDeadline()->format("Y-m-d\TH:i:sP");
        }
        if (null !== $object->getSourceLanguage()) {
            $data->{'sourceLanguage'} = $object->getSourceLanguage();
        }
        if (null !== $object->getDocumentDisassemblingStatus()) {
            $data->{'documentDisassemblingStatus'} = $object->getDocumentDisassemblingStatus();
        }
        if (null !== $object->getTargetLanguage()) {
            $data->{'targetLanguage'} = $object->getTargetLanguage();
        }
        if (null !== $object->getStatus()) {
            $data->{'status'} = $object->getStatus();
        }
        if (null !== $object->getWordsCount()) {
            $data->{'wordsCount'} = $object->getWordsCount();
        }
        if (null !== $object->getStatusModificationDate()) {
            $data->{'statusModificationDate'} = $object->getStatusModificationDate()->format("Y-m-d\TH:i:sP");
        }
        if (null !== $object->getPretranslateCompleted()) {
            $data->{'pretranslateCompleted'} = $object->getPretranslateCompleted();
        }
        if (null !== $object->getWorkflowStages()) {
            $values = array();
            foreach ($object->getWorkflowStages() as $value) {
                $values[] = $this->serializer->serialize($value, 'raw', $context);
            }
            $data->{'workflowStages'} = $values;
        }
        if (null !== $object->getExternalId()) {
            $data->{'externalId'} = $object->getExternalId();
        }
        if (null !== $object->getMetaInfo()) {
            $data->{'metaInfo'} = $object->getMetaInfo();
        }
        return $data;
    }
}