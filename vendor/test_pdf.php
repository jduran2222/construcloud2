<?php

namespace Google\Cloud\Samples\Vision;

require 'autoload.php';
 putenv('GOOGLE_APPLICATION_CREDENTIALS=construcloud-228009-a3014d1d8608.json');


use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Vision\V1\AnnotateFileResponse;
use Google\Cloud\Vision\V1\AsyncAnnotateFileRequest;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\GcsDestination;
use Google\Cloud\Vision\V1\GcsSource;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\InputConfig;
use Google\Cloud\Vision\V1\OutputConfig;

// $path = 'gs://path/to/your/document.pdf'
 $path = 'gs://deposito_jduran2222/factura.pdf' ;

function detect_pdf_gcs($path, $output)
{
    # select ocr feature
    $feature = (new Feature())
        ->setType(Type::DOCUMENT_TEXT_DETECTION);

    # set $path (file to OCR) as source
    $gcsSource = (new GcsSource())
        ->setUri($path);
    # supported mime_types are: 'application/pdf' and 'image/tiff'
    $mimeType = 'application/pdf';
    $inputConfig = (new InputConfig())
        ->setGcsSource($gcsSource)
        ->setMimeType($mimeType);

    # set $output as destination
    $gcsDestination = (new GcsDestination())
        ->setUri($output);
    # how many pages should be grouped into each json output file.
    $batchSize = 2;
    $outputConfig = (new OutputConfig())
        ->setGcsDestination($gcsDestination)
        ->setBatchSize($batchSize);

    # prepare request using configs set above
    $request = (new AsyncAnnotateFileRequest())
        ->setFeatures([$feature])
        ->setInputConfig($inputConfig)
        ->setOutputConfig($outputConfig);
    $requests = [$request];

    # make request
    $imageAnnotator = new ImageAnnotatorClient();
    $operation = $imageAnnotator->asyncBatchAnnotateFiles($requests);
    print('Waiting for operation to finish.' . PHP_EOL);
    $operation->pollUntilComplete();

    # once the request has completed and the output has been
    # written to GCS, we can list all the output files.
    preg_match('/^gs:\/\/([a-z0-9\._\-]+)\/(\S+)$/', $output, $match);
    echo $match[0];
    $bucketName = $match[1];
    $prefix = $match[2];

    $storage = new StorageClient();
    $bucket = $storage->bucket($bucketName);
    $options = ['prefix' => $prefix];
    $objects = $bucket->objects($options);

    # save first object for sample below
    $objects->next();
    $firstObject = $objects->current();

    # list objects with the given prefix.
    print('Output files:' . PHP_EOL);
    foreach ($objects as $object) {
        print($object->name() . PHP_EOL);
    }

    # process the first output file from GCS.
    # since we specified batch_size=2, the first response contains
    # the first two pages of the input file.
    $jsonString = $firstObject->downloadAsString();
    $firstBatch = new AnnotateFileResponse();
    $firstBatch->mergeFromJsonString($jsonString);

    # get annotation and print text
    foreach ($firstBatch->getResponses() as $response) {
        $annotation = $response->getFullTextAnnotation();
        print($annotation->getText());
    }

    $imageAnnotator->close();
}

$output="juan" ;
detect_pdf_gcs($path,'gs://deposito_jduran2222/') ;

echo "<br>PRINT OUTPUT:<BR>" ;
echo $output ;