<?php

declare(strict_types=1);

namespace contentreactor\craftckconfigs\services;

use Craft;
use craft\helpers\StringHelper;
use Exception;
use yii\base\Component;

class Config extends Component
{
	public function generateAllConfigs(): void
	{
		$this->generateFullConfig();
		$this->generateSmallConfig();
		$this->generateMiddleConfig();
	}

	public function generateSmallConfig(): void
	{
		$data = [
			"headingLevels" => [
				1,
				2,
				3,
				4,
				5,
				6,
			],
			"name" => "Small",
			"options" => [
				"htmlSupport" => [
					"allow" => [
						[
							"class" => [
								"entity-shy"
							],
							"name" => "span"
						]
					]
				],
			],
			"toolbar" => [
				"undo",
				"redo",
				"|",
				"bold",
				"italic",
				"tokens",
				"|",
				"link",
				"|",
				"removeFormat",
				"|",
				"sourceEditing",
			],
		];
		$this->generateCkConfig($data);
	}

	public function generateMiddleConfig(): void
	{
		$data = [
			"headingLevels" => [
				1,
				2,
				3,
				4,
				5,
				6,
			],
			"name" => "Middle",
			"options" => [
				"alignment" => [
					"options" => [
						"left",
						"center",
						"right",
					],
				],
				"htmlSupport" => [
					"allow" => [
						[
							"class" => [
								"entity-shy"
							],
							"name" => "span"
						]
					]
				],
			],
			"toolbar" => [
				"undo",
				"redo",
				"'|'",
				"heading",
				"'|'",
				"bold",
				"italic",
				"underline",
				"fontColor",
				"alignment",
				"tokens",
				"'|'",
				"link",
				"'|'",
				"removeFormat",
				"'|'",
				"sourceEditing",
			],
		];
		$this->generateCkConfig($data);
	}

	public function generateFullConfig(): void
	{
		$data = [
			"headingLevels" => [
				1,
				2,
				3,
				4,
				5,
				6,
			],
			"name" => "Full",
			"options" => [
				"alignment" => [
					"options" => [
						"left",
						"center",
						"right",
					],
				],
				"htmlSupport" => [
					"allow" => [
						[
							"class" => [
								"entity-shy"
							],
							"name" => "span"
						]
					]
				],
			],
			"toolbar" => [
				"undo",
				"redo",
				"|",
				"heading",
				"|",
				"bold",
				"italic",
				"underline",
				"strikethrough",
				"fontColor",
				"link",
				"alignment",
				"tokens",
				"|",
				"bulletedList",
				"numberedList",
				"todoList",
				"|",
				"insertImage",
				"mediaEmbed",
				"insertTable",
				"horizontalLine",
				"createEntry",
				"|",
				"removeFormat",
				"|",
				"sourceEditing",
			],
		];
		$this->generateCkConfig($data);
	}

	public function generateCkConfig(array $config): void
	{
		$uid = StringHelper::UUID();
		$configName = $config['name'];
		$pc = Craft::$app->getProjectConfig();
		$configs = $pc->get("ckeditor.configs");
		if ($configs) {
			$configNames = array_map(function (array $config) {
				return $config['name'];
			}, $configs);
			if (in_array($configName, $configNames)) {
				return;
			}
		}
		$pc->set("ckeditor.configs.$uid", $config, "Create CKEditor config $configName via plugin");
	}

	public function removeCkConfigs(): void
	{
		$pc = Craft::$app->getProjectConfig();
		$configs = $pc->get("ckeditor.configs");
		foreach ($configs as $uid => $config) {
			$pc->remove("ckeditor.configs.$uid");
		}
	}
}
