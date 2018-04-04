<?php

use Digia\GraphQL\GraphQL as DigiaGraphQL;
use GraphQL\Language\Parser as WebonyxParser;
use Youshido\GraphQL\Parser\Parser as YoushidoParser;

/**
 * @BeforeMethods({"init"})
 * @ParamProviders({"provideQueries"})
 */
class ParseQuery {

  const FIXTURES = __DIR__ . '/../fixtures';

  /**
   * @var string
   */
  protected $schema;

  /**
   * Loads the schema.
   */
  public function init() {
    $this->schema = file_get_contents(static::FIXTURES . '/schema.graphql');
  }

  /**
   * Loads the query fixtures.
   *
   * @return array
   */
  public function provideQueries() {
    $glob = glob(static::FIXTURES . '/queries/*.graphql');
    $files = array_map(function ($file) {
      return ['query' => file_get_contents($file)];
    }, $glob);

    return $files;
  }

  public function benchDigiaonline(array $params) {
    DigiaGraphQL::parse($params['query'], []);
  }

  public function benchWebonyx(array $params) {
    WebonyxParser::parse($params['query'], []);
  }

  public function benchYoushido(array $params) {
    $parser = new YoushidoParser();
    $parser->parse($params['query']);
  }

}