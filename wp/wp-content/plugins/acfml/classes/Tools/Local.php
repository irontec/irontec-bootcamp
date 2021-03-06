<?php

namespace ACFML\Tools;

class Local extends Transfer {
	/**
	 * @var \WPML_ACF_Field_Settings
	 */
	private $field_settings;

	public function __construct( \WPML_ACF_Field_Settings $field_settings ) {
		$this->field_settings = $field_settings;
	}


	public function init() {
		if ( ! $this->isImportFromFile() ) {
			add_filter( 'acf/prepare_field_group_for_import', [ $this, 'unsetTranslated' ] );
			if ( is_admin() && $this->shouldScan() ) {
				add_filter( 'acf/prepare_fields_for_import', [ $this, 'syncTranslationPreferences' ] );
			}
		}
	}

	/**
	 * @param array $fieldGroup
	 *
	 * @return array
	 */
	public function unsetTranslated( $fieldGroup ) {
		if ( $this->isGroupTranslatable() && isset( $fieldGroup[ self::LANGUAGE_PROPERTY ], $fieldGroup['key'] ) ) {
			if ( apply_filters( 'wpml_current_language', null ) !== $fieldGroup[ self::LANGUAGE_PROPERTY ] ) {
				// reset field group but keep 'key', otherwise ACF will php notice.
				$fieldGroup = [
					'key' => $fieldGroup['key'],
				];
			}
		}

		return $fieldGroup;
	}

	/**
	 * @param array $fields
	 *
	 * @return mixed
	 */
	public function syncTranslationPreferences( $fields ) {
		foreach ( $fields as $field ) {
			$this->field_settings->update_field_settings( $field );
		}
		return $fields;
	}

	private function isImportFromFile() {
		return isset( $_FILES['acf_import_file'] );
	}

	/**
	 * Scan should happen if user not defined constant or constant is set to boolean true.
	 *
	 * @return bool
	 */
	private function shouldScan() {
		return ! defined( 'ACFML_SCAN_LOCAL_FIELDS' ) || constant( 'ACFML_SCAN_LOCAL_FIELDS' );
	}
}
