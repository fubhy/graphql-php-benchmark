<?php

use Digia\GraphQL\GraphQL as DigiaGraphQL;
use GraphQL\Language\Parser as WebonyxParser;

/**
 * @BeforeMethods({"init"})
 */
class ParseSchema {

  const FIXTURES = __DIR__ . '/../fixtures';

  /**
   * The schema source.
   *
   * @var string
   */
  protected $schema;

  /**
   * Loads the schema definition string from the file.
   */
  public function init() {
    $this->schema = file_get_contents(static::FIXTURES . '/schema.graphql');
  }

  public function benchDigiaonline() {
    DigiaGraphQL::parse($this->schema, []);
  }

  public function benchWebonyx() {
    WebonyxParser::parse($this->schema, []);
  }

  /**
   * @Skip
   */
  public function benchYoushido() {
    // Not supported :(.
  }

}