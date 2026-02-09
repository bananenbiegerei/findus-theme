# ACF JSON Structure

This document explains how ACF field groups are organized in this theme.

## Locations

ACF JSON files are stored in two locations:

### 1. `acf-json/` (this folder)
**For global/shared field groups only:**
- Clone Library (`group_69870e5a53c87`) - Reusable fields cloned by blocks
- Options page fields (`group_6989a178e4010`) - Site-wide settings
- Page/Post fields (`group_697b282eb3b89`, `group_6989aaf41b331`) - Fields for pages/posts
- Nested block structures (`group_697b7021e948e`) - 2nd level columns for nesting

### 2. `bb-blocks/bb-block-*/`
**For block-specific field groups:**
- Each block folder contains its own `group_*.json`
- These are auto-loaded by `bb-blocks/init.php`

## Naming Convention

| Prefix | Location | Purpose |
|--------|----------|---------|
| `group_bb_*` | `bb-blocks/` | Block-specific fields |
| `group_69*` | Either | Legacy naming (check location rule below) |

## How to Decide Where a Field Group Goes

Ask: **"Is this field group tied to a specific block?"**

- **YES** → Put it in `bb-blocks/bb-block-{name}/`
- **NO** → Put it in `acf-json/`

### Examples

| Field Group | Location | Reason |
|-------------|----------|--------|
| Block: Image | `bb-blocks/bb-block-image/` | Specific to image block |
| Block: Card | `bb-blocks/bb-block-card/` | Specific to card block |
| Clone Library | `acf-json/` | Shared by multiple blocks |
| Options | `acf-json/` | Site-wide settings |
| Block: Columns 2nd level | `acf-json/` | Nested structure used by columns |

## Clone Library (`group_69870e5a53c87`)

Contains reusable fields that blocks can clone:
- `field_6979efb3a1889` - Aspect Ratio (aspect-din-portrait, aspect-din-landscape, aspect-din-panorama)
- `field_697a0007card7` - Background Color

**Important:** The Clone Library location should be empty `[]` so it doesn't display directly on any edit screen.

## Syncing Fields

When you modify fields in WordPress admin:
1. ACF saves to the location where the field group was originally loaded from
2. Block field groups save to their `bb-blocks/` folder
3. Global field groups save to `acf-json/`

## Troubleshooting

### "Unknown field group" error in clone field
The cloned field group doesn't exist. Check:
1. Is the group key correct?
2. Does the JSON file exist in the right location?
3. Is the file valid JSON?

### Fields not showing on block
1. Check `location` in the JSON matches the block name (e.g., `bb/image`)
2. Ensure the block is registered and enabled in Options

### Duplicate field groups
If the same group appears in both locations, delete one. Priority:
- Block-specific → keep in `bb-blocks/`
- Shared/global → keep in `acf-json/`
