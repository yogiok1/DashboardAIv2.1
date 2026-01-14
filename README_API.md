# Dashboard AI v2 - API Documentation

Complete API documentation for all endpoints in Dashboard AI system.

---

## 📋 Table of Contents

1. [System Architecture](#system-architecture)
2. [Authentication](#authentication)
3. [Data Import APIs](#data-import-apis)
4. [Web Bima Integration APIs](#web-bima-integration-apis)
5. [AI Model Testing APIs](#ai-model-testing-apis)
6. [Evaluation Result APIs](#evaluation-result-apis)
7. [Proposal Group APIs](#proposal-group-apis)
8. [Response Formats](#response-formats)
9. [Error Handling](#error-handling)

---

## 🏗️ System Architecture

### Data Flow Overview

```
┌─────────────────┐
│   WEB BIMA      │ (External System)
│  Upload Data    │
└────────┬────────┘
         │ POST /api/bima/*
         │ (Upload Files + Metadata)
         ▼
┌─────────────────────────────────────────┐
│     DASHBOARD AI (Main Application)     │
│                                         │
│  1. Receive data from Bima              │
│  2. Store files to storage/             │
│  3. Save metadata to database           │
│                                         │
│  4. Send request to AI Model  ─────────┼──►  ┌──────────────────┐
│     POST /api/evaluation-test           │      │  AI SERVICE      │
│                                         │      │  (RunPod)        │
│  6. Receive callback ◄──────────────────┼──────│                  │
│     POST /api/evaluation-result         │      │  5. Process data │
│  7. Update database & display           │      │     Evaluate     │
│                                         │      │     Return scores│
└─────────────────────────────────────────┘      └──────────────────┘
```

### Request Flow

1. **Frontend** (`/tools` page) → User clicks "Run Model Test"
2. **Backend** (`/api/evaluation-test`) → Validates and forwards to AI
3. **AI Service** (RunPod) → Processes evaluation
4. **Callback** (`/api/evaluation-result`) → AI sends results back
5. **Display** (`/proposal-results/{id}/detail`) → Shows results to user

---

## 🔐 Authentication

### Current Status

-   **Development**: No authentication required
-   **Production**: Add `auth:sanctum` middleware to routes

### Example with Sanctum (Production)

```php
// routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/evaluation-test', [EvaluationResultController::class, 'test']);
});
```

**Request Headers**:

```
Authorization: Bearer {your-api-token}
Content-Type: application/json
Accept: application/json
```

---

## 📥 Data Import APIs

### 1. Import Training/Test Data

Import proposal data with metadata for training or testing purposes.

**Endpoint**: `POST /api/data/import`

**Request Body**:

```json
{
    "instrument_path": "PPDM",
    "scheme": "PPDM",
    "proposals": [
        {
            "filename": "proposal_001.pdf",
            "filepath": "storage/proposals/proposal_001.pdf",
            "status": "done"
        },
        {
            "filename": "proposal_002.pdf",
            "filepath": "storage/proposals/proposal_002.pdf",
            "status": "done"
        }
    ]
}
```

**Response Success**:

```json
{
    "success": true,
    "message": "Data imported successfully",
    "data": {
        "group": {
            "id": 1,
            "code": "GRP-PPDM-1735905600",
            "name": "PPDM - PPDM",
            "scheme": "PPDM",
            "instrument_path": "PPDM"
        },
        "proposals_processed": 2,
        "proposals_failed": 0
    },
    "errors": []
}
```

---

### 2. Get Import Status

Get status of imported data groups with statistics.

**Endpoint**: `GET /api/data/status`

**Query Parameters**:

-   `type` (optional): Filter by type (`current` or `history`)
-   `data_type` (optional): Filter by data type (`training`, `test`, `sekarang`)

**Example**: `GET /api/data/status?type=current&data_type=training`

**Response**:

```json
{
    "success": true,
    "summary": {
        "total_groups": 3,
        "total_proposals": 45,
        "uploaded": 42,
        "failed": 3
    },
    "groups": [
        {
            "id": 1,
            "group_code": "GRP-PPDM-1735905600",
            "group_name": "PPDM - PPDM",
            "scheme": "PPDM",
            "type": "current",
            "path": "ppdm",
            "total_files": 15,
            "uploaded_at": "2026-01-03T10:30:00Z",
            "proposals": [
                {
                    "id": 1,
                    "filename": "proposal_001.pdf",
                    "status": "uploaded"
                }
            ]
        }
    ]
}
```

---

## 🌐 Web Bima Integration APIs

### 1. Import Proposal Groups

Upload proposal group with PDF files from Web Bima.

**Endpoint**: `POST /api/bima/proposal-groups`

**Request Body**:

```json
{
    "scheme": "PPDM",
    "type": "current",
    "path": "training",
    "group_name": "Kelompok A 2025",
    "group_code": "KLP-A-2025",
    "proposals": [
        {
            "filename": "proposal_001.pdf",
            "file_content": "JVBERi0xLjQK...",
            "size": 1024000
        },
        {
            "filename": "proposal_002.pdf",
            "file_url": "https://bima.upi.edu/storage/proposal_002.pdf",
            "size": 2048000
        }
    ]
}
```

**Field Descriptions**:

-   `file_content`: Base64 encoded file content (optional if `file_url` provided)
-   `file_url`: External URL to file (optional if `file_content` provided)
-   `group_code`: Optional, will be auto-generated if not provided
-   `type`: Must be `current` or `history`
-   `path`: Optional, must be `training`, `test`, or `sekarang`

**Response Success**:

```json
{
    "success": true,
    "message": "Proposal group imported successfully",
    "data": {
        "group": {
            "id": 1,
            "code": "current_PPDM_2026_01_03_001",
            "name": "Kelompok A 2025",
            "scheme": "PPDM",
            "type": "current",
            "path": "training"
        },
        "proposals_processed": 2,
        "proposals_failed": 0,
        "proposals": [
            {
                "id": 1,
                "filename": "proposal_001.pdf"
            },
            {
                "id": 2,
                "filename": "proposal_002.pdf"
            }
        ]
    },
    "errors": []
}
```

**Storage Location**: `storage/app/public/proposals/{group_code}/{timestamp}_{filename}`

---

### 2. Get Proposal Groups

Retrieve all proposal groups with optional filtering.

**Endpoint**: `GET /api/bima/proposal-groups`

**Query Parameters**:

-   `type` (optional): Filter by type (`current` or `history`)
-   `scheme` (optional): Filter by scheme name

**Example**: `GET /api/bima/proposal-groups?type=current&scheme=PPDM`

**Response**:

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "group_code": "current_PPDM_2026_01_03_001",
            "group_name": "Kelompok A 2025",
            "scheme": "PPDM",
            "type": "current",
            "path": "training",
            "total_files": 2,
            "uploaded_at": "2026-01-03T10:30:00Z",
            "status": "uploaded",
            "proposals": [
                {
                    "id": 1,
                    "filename": "proposal_001.pdf",
                    "path": "proposals/current_PPDM_2026_01_03_001/1735905600_proposal_001.pdf",
                    "size": 1024000,
                    "status": "uploaded"
                }
            ]
        }
    ]
}
```

---

### 3. Import Rubrics

Upload evaluation rubric files.

**Endpoint**: `POST /api/bima/rubrics`

**Request Body**:

```json
{
    "rubric_name": "Rubrik Penilaian PPDM 2025",
    "file_content": "JVBERi0xLjQK...",
    "file_extension": "pdf"
}
```

**Alternative with URL**:

```json
{
    "rubric_name": "Rubrik Penilaian PPDM 2025",
    "file_url": "https://bima.upi.edu/storage/rubrik_ppdm_2025.pdf"
}
```

**Response**:

```json
{
    "success": true,
    "message": "Rubric imported successfully",
    "data": {
        "id": 1,
        "rubric_name": "Rubrik Penilaian PPDM 2025",
        "file_path": "rubrics/uuid-rubric.pdf",
        "created_at": "2026-01-03T10:30:00Z"
    }
}
```

**Storage Location**: `storage/app/public/rubrics/{uuid}.{extension}`

---

### 4. Get Rubrics

Retrieve all rubrics.

**Endpoint**: `GET /api/bima/rubrics`

**Response**:

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "rubric_name": "Rubrik Penilaian PPDM 2025",
            "file_path": "rubrics/uuid-rubric.pdf",
            "created_at": "2026-01-03T10:30:00Z",
            "updated_at": "2026-01-03T10:30:00Z"
        }
    ]
}
```

---

### 5. Import Metadata

Upload additional metadata files.

**Endpoint**: `POST /api/bima/metadata`

**Request Body**:

```json
{
    "title": "Penelitian AI untuk Pendidikan",
    "description": "Deskripsi penelitian lengkap",
    "abstract": "Abstrak penelitian",
    "category": "Penelitian",
    "field_of_study": "Computer Science",
    "keywords": "AI, Education, Machine Learning",
    "researcher_id": "RES001",
    "researcher_name": "Dr. John Doe",
    "study_program": "Teknik Informatika",
    "institution": "Universitas Pendidikan Indonesia",
    "year": 2025,
    "semester": "Genap",
    "upload_code": "META-ABC123",
    "files": [
        {
            "filename": "document.pdf",
            "file_content": "JVBERi0xLjQK..."
        },
        {
            "filename": "presentation.pptx",
            "file_url": "https://example.com/presentation.pptx"
        }
    ],
    "output_type": "journal",
    "status": "draft"
}
```

**Field Descriptions**:

-   `title`: Required - Metadata title
-   All other fields are optional
-   `upload_code`: Auto-generated if not provided (format: META-XXXXXXXX)
-   `status`: Must be `draft`, `published`, or `archived`
-   `files`: Array of files with `file_content` (base64) or `file_url`

**Response**:

```json
{
    "success": true,
    "message": "Metadata imported successfully",
    "data": {
        "id": 1,
        "title": "Penelitian AI untuk Pendidikan",
        "upload_code": "META-ABC123",
        "researcher_name": "Dr. John Doe",
        "year": 2025,
        "files_count": 2,
        "created_at": "2026-01-03T10:30:00Z"
    }
}
```

**Storage Location**: `storage/app/public/metadata_files/{upload_code}/{uuid}.{extension}`

---

### 6. Get Metadata

Retrieve metadata with optional filtering.

**Endpoint**: `GET /api/bima/metadata`

**Query Parameters**:

-   `year` (optional): Filter by year
-   `category` (optional): Filter by category
-   `status` (optional): Filter by status (`draft`, `published`, `archived`)

**Example**: `GET /api/bima/metadata?year=2025&status=published`

**Response**:

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Penelitian AI untuk Pendidikan",
            "description": "Deskripsi penelitian lengkap",
            "researcher_name": "Dr. John Doe",
            "year": 2025,
            "upload_code": "META-ABC123",
            "status": "draft",
            "created_at": "2026-01-03T10:30:00Z"
        }
    ]
}
```

---

### 7. Import Extras

Upload extra files (templates, guides, etc.).

**Endpoint**: `POST /api/bima/extras`

**Request Body**:

```json
{
    "extra_name": "Template Proposal PPDM",
    "file_content": "UEsDBBQACAgI..."
}
```

**Alternative with URL**:

```json
{
    "extra_name": "Template Proposal PPDM",
    "file_url": "https://example.com/template.docx"
}
```

**Response**:

```json
{
    "success": true,
    "message": "Extra file imported successfully",
    "data": {
        "id": 1,
        "extra_name": "Template Proposal PPDM",
        "file_path": "extras/1735905600_Template Proposal PPDM.docx",
        "created_at": "2026-01-03T10:30:00Z"
    }
}
```

**Storage Location**: `storage/app/public/extras/{timestamp}_{extra_name}.docx`

---

### 8. Get Extras

Retrieve all extra files.

**Endpoint**: `GET /api/bima/extras`

**Response**:

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "extra_name": "Template Proposal PPDM",
            "file_path": "extras/1735905600_Template Proposal PPDM.docx",
            "created_at": "2026-01-03T10:30:00Z"
        }
    ],
    "total": 1
}
```

---

## 🤖 AI Model Testing APIs

### 1. Direct Model Test

Send data directly to AI model for evaluation (recommended method).

**Endpoint**: `POST /api/model/direct-test`

**Request Body**:

```json
{
    "instrument_path": "PPDM",
    "scheme": "PPDM",
    "proposals": [
        {
            "filename": "proposal_001.pdf",
            "filepath": "storage/proposals/proposal_001.pdf",
            "status": "done"
        },
        {
            "filename": "proposal_002.pdf",
            "filepath": "storage/proposals/proposal_002.pdf",
            "status": "done"
        }
    ]
}
```

**Field Descriptions**:

-   `instrument_path`: Path to evaluation instrument
-   `scheme`: Scheme name (e.g., PPDM, PDP)
-   `status`: Must be `done` or `failed`

**Response Success**:

```json
{
    "success": true,
    "message": "Model test completed successfully",
    "ai_response": {
        "status": "success",
        "results": [
            {
                "filename": "proposal_001.pdf",
                "score": 85.5,
                "recommendation": "DITERIMA"
            }
        ]
    }
}
```

**Response Error - AI Service Unavailable**:

```json
{
    "success": false,
    "message": "Failed to connect to AI Model endpoint",
    "error": "Connection timeout after 120 seconds"
}
```

**Configuration**:

Set `AI_MODEL_ENDPOINT` in `.env`:

```env
AI_MODEL_ENDPOINT=https://your-ai-service.com/api/evaluate
```

---

### 2. Evaluation Test (Frontend → AI Service)

Send evaluation request from frontend/tools page to AI service.

**Endpoint**: `POST /api/evaluation-test`

**Request Body**:

```json
{
    "proposal_group": 1,
    "rubric_id": 1,
    "extra_id": "2",
    "assessment_type": "gabungan_selected"
}
```

**Field Descriptions**:

-   `proposal_group`: ID of proposal group to evaluate
-   `rubric_id`: ID of rubric to use for evaluation
-   `extra_id`: ID of extra file (optional, use `"-"` for none)
-   `assessment_type`: Type of assessment
    -   `administrasi`: Administration only
    -   `substansi`: Substance only
    -   `gabungan_naive`: Combined (naive method)
    -   `gabungan_selected`: Combined (selected method)

**Backend Processing**:

The controller automatically builds the complete payload:

```json
{
    "username": "admin",
    "scheme": "Rubrik Penilaian PPDM 2025",
    "year": 2026,
    "assessment_type": "gabungan_selected",
    "ml_sub": true,
    "instrument": {
        "administrasi": "http://72.61.215.182/storage/rubrics/admin.docx",
        "substansi": "http://72.61.215.182/storage/rubrics/substansi.docx"
    },
    "extra_path": "http://72.61.215.182/storage/extras/template.docx",
    "proposal_group": 1,
    "proposals": [
        {
            "id_proposal": 1,
            "filename": "proposal_001.pdf",
            "filepath": "http://72.61.215.182/storage/proposals/current_PPDM_2026_01_03_001/proposal_001.pdf",
            "status": 0
        },
        {
            "id_proposal": 2,
            "filename": "proposal_002.pdf",
            "filepath": "http://72.61.215.182/storage/proposals/current_PPDM_2026_01_03_001/proposal_002.pdf",
            "status": 1
        }
    ]
}
```

**Response Success**:

```json
{
    "success": true,
    "message": "Request sent to AI service successfully",
    "sent_payload": {
        "username": "admin",
        "scheme": "Rubrik Penilaian PPDM 2025",
        "assessment_type": "gabungan_selected",
        "proposals": []
    },
    "ai_response": {
        "status": "processing",
        "message": "Evaluation started"
    }
}
```

**Response Error**:

```json
{
    "success": false,
    "message": "AI_MODEL_ENDPOINT not configured in .env",
    "error": "Please set AI_MODEL_ENDPOINT in .env"
}
```

---

## 📊 Evaluation Result APIs

### 1. Receive Evaluation Results (AI → Backend Callback)

AI service sends evaluation results back to this endpoint.

**Endpoint**: `POST /api/evaluation-result`

**Request Body** (from AI Service):

```json
{
    "id": "acca60df",
    "user": "admin",
    "proposal_id": 27,
    "proposal_group": 9,
    "status": 1,
    "start_time": "2026-01-03 11:52:10",
    "processing_time": "17 menit 27.26 detik",
    "file_info": {
        "proposal": "1766462251_proposal.pdf",
        "detected_scheme_code": "PDP - 2",
        "year": 2025
    },
    "final_result": {
        "final_recommendation": "DITERIMA (LOLOS)",
        "summary": "Admin: LOLOS, Subs Score: 98.25"
    },
    "ml_result": "Lolos",
    "details": {
        "administrasi": {
            "items": [
                {
                    "indicator": "Ketua dan Anggota memiliki jabatan fungsional Maksimal Lektor.",
                    "score": 1
                },
                {
                    "indicator": "Anggota pengusul minimal 2 orang.",
                    "score": 1
                },
                {
                    "indicator": "Anggota pengusul maksimal 4 orang.",
                    "score": 1
                }
            ],
            "total_score": 5,
            "status": "LOLOS"
        },
        "substansi": {
            "items": [
                {
                    "indicator": "a. Publikasi, KI, buku ketua pengusul yang disitasi pada proposal",
                    "score": 3,
                    "reason": "Pengusul memiliki rekam jejak publikasi yang cukup baik",
                    "weight": 3.0,
                    "weighted_score": 2.25
                },
                {
                    "indicator": "b. Relevansi kepakaran pengusul dengan tema proposal",
                    "score": 4,
                    "reason": "Kepakaran sangat relevan dengan tema proposal",
                    "weight": 3.0,
                    "weighted_score": 3.0
                }
            ],
            "total_weighted_score": 98.25,
            "summary": "Proposal menunjukkan kualitas tinggi dalam semua aspek penilaian.",
            "max_item_score": 4,
            "min_item_score": 3
        }
    }
}
```

**Field Descriptions**:

-   `status`: Integer status code (0 = pending, 1 = completed, 2 = failed)
-   `ml_result`: ML prediction, accepts:
    -   "Lolos" → normalized to "LOLOS"
    -   "Tidak Lolos" → normalized to "TIDAK LOLOS"
    -   Case insensitive
-   `processing_time`: Supports multiple formats:
    -   Indonesian: "17 menit 27.26 detik"
    -   Short: "1m 23s" or "45.23s"
    -   Plain seconds: "45.23"
-   `administrasi.status`: Status from AI (LOLOS/TIDAK LOLOS)
-   `substansi.total_weighted_score`: Final weighted score (0-100)

**Response Success**:

```json
{
    "success": true,
    "message": "Evaluation result stored successfully",
    "data": {
        "proposal_id": 27,
        "proposal_group_id": 9,
        "evaluation_id": "acca60df",
        "filename": "1766462251_proposal.pdf",
        "evaluation_status": "lolos",
        "assessment_status": 3,
        "ai_score": 98.25,
        "ml_result": "LOLOS",
        "admin_score": 5,
        "admin_status": "LOLOS",
        "substansi_score": 98.25,
        "processing_time": "17 menit 27.26 detik"
    }
}
```

**Assessment Status Values**:

-   `0`: Not yet evaluated
-   `1`: Administration evaluated only
-   `2`: Substance evaluated only
-   `3`: Both evaluated

**Database Updates**:

Updates `proposals` table with:

-   `evaluation_id`: Unique evaluation ID from AI
-   `evaluator_username`: Username from request
-   `evaluation_start_time`: Timestamp when evaluation started
-   `processing_time`: Processing duration
-   `evaluation_status`: lolos/tidak_lolos/dinilai (mapped from recommendation)
-   `assessment_status`: 0-3 (based on what was evaluated)
-   `admin_score`: Administration score (sum of items)
-   `admin_status`: LOLOS/TIDAK LOLOS
-   `substansi_score`: Weighted substansi score
-   `substansi_max_score`: Max individual item score
-   `substansi_min_score`: Min individual item score
-   `substansi_summary`: Summary text from AI
-   `ml_result`: Normalized ML prediction
-   `ai_score`: Same as substansi_score (or admin_score if substansi not available)
-   `ai_notes`: Summary from final_result
-   `json_result`: Complete JSON response stored as text

**Response Error - Validation Failed**:

```json
{
    "success": false,
    "message": "Validation error",
    "errors": {
        "proposal_id": ["The proposal id field is required."],
        "details": ["The details field is required."]
    }
}
```

**Response Error - Proposal Not Found**:

```json
{
    "success": false,
    "message": "Error storing evaluation result",
    "error": "No query results for model [App\\Models\\Proposal] 27"
}
```

---

## 📁 Proposal Group APIs

### 1. Get Proposals by Group ID

Load all proposals in a specific proposal group.

**Endpoint**: `GET /api/proposal-groups/{id}/proposals`

**Example**: `GET /api/proposal-groups/1/proposals`

**Response**:

```json
{
    "success": true,
    "group": {
        "id": 1,
        "group_name": "Kelompok A 2025",
        "scheme": "PPDM",
        "uploaded_at": "2026-01-03T10:30:00Z"
    },
    "proposals": [
        {
            "id": 1,
            "filename": "proposal_001.pdf",
            "path": "proposals/current_PPDM_2026_01_03_001/1735905600_proposal_001.pdf",
            "status": "uploaded",
            "size": 1024000
        },
        {
            "id": 2,
            "filename": "proposal_002.pdf",
            "path": "proposals/current_PPDM_2026_01_03_001/1735905601_proposal_002.pdf",
            "status": "pending",
            "size": 2048000
        }
    ]
}
```

**Response Error - Group Not Found**:

```json
{
    "success": false,
    "message": "Failed to load proposals",
    "error": "No query results for model [App\\Models\\ProposalGroup] 999"
}
```

**Usage in Frontend**:

```javascript
// Load proposals when group is selected
async function loadProposalsFromGroup(groupId) {
    try {
        const response = await fetch(
            `/api/proposal-groups/${groupId}/proposals`
        );
        const data = await response.json();

        if (data.success) {
            window.selectedProposals = data.proposals;
            window.selectedGroup = data.group;
            displayProposals(data.proposals);
        } else {
            console.error("Failed to load proposals:", data.message);
        }
    } catch (error) {
        console.error("Error loading proposals:", error);
    }
}
```

---

## 📝 Response Formats

### Success Response

```json
{
    "success": true,
    "message": "Operation completed successfully",
    "data": {
        // Response data here
    }
}
```

### Error Response

```json
{
    "success": false,
    "message": "Error description",
    "errors": {
        "field_name": ["Validation error message"]
    }
}
```

### Validation Error (422)

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "instrument_path": ["The instrument path field is required."],
        "proposal_group_id": ["The proposal group id must be an integer."]
    }
}
```

---

## ⚠️ Error Handling

### Common HTTP Status Codes

| Code | Meaning               | Description                   |
| ---- | --------------------- | ----------------------------- |
| 200  | OK                    | Request successful            |
| 201  | Created               | Resource created successfully |
| 400  | Bad Request           | Invalid request format        |
| 401  | Unauthorized          | Authentication required       |
| 403  | Forbidden             | Insufficient permissions      |
| 404  | Not Found             | Resource not found            |
| 422  | Unprocessable Entity  | Validation failed             |
| 500  | Internal Server Error | Server error                  |
| 503  | Service Unavailable   | AI service unreachable        |

### Error Examples

**404 - Proposal Not Found**:

```json
{
    "success": false,
    "message": "Proposal not found with the given criteria",
    "error_code": "PROPOSAL_NOT_FOUND"
}
```

**503 - AI Service Unavailable**:

```json
{
    "success": false,
    "message": "Failed to connect to AI service",
    "error": "Connection timeout after 30 seconds"
}
```

---

## 🧪 Testing APIs

### Using cURL

**Test Data Import**:

```bash
curl -X POST http://localhost:8000/api/data/import \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "instrument_path": "PPDM",
    "scheme": "PPDM",
    "proposals": [
        {
            "filename": "test_proposal.pdf",
            "filepath": "storage/proposals/test_proposal.pdf",
            "status": "done"
        }
    ]
}'
```

**Test Direct Model**:

```bash
curl -X POST http://localhost:8000/api/model/direct-test \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "instrument_path": "PPDM",
    "scheme": "PPDM",
    "proposals": [
        {
            "filename": "test.pdf",
            "filepath": "storage/proposals/test.pdf",
            "status": "done"
        }
    ]
}'
```

**Test Evaluation Request**:

```bash
curl -X POST http://localhost:8000/api/evaluation-test \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "proposal_group": 1,
    "rubric_id": 1,
    "extra_id": "-",
    "assessment_type": "gabungan_selected"
}'
```

**Get Proposals from Group**:

```bash
curl -X GET http://localhost:8000/api/proposal-groups/1/proposals \
  -H "Accept: application/json"
```

**Get Proposal Groups**:

```bash
curl -X GET "http://localhost:8000/api/bima/proposal-groups?type=current" \
  -H "Accept: application/json"
```

**Import Proposal Group**:

```bash
curl -X POST http://localhost:8000/api/bima/proposal-groups \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "scheme": "PPDM",
    "type": "current",
    "path": "training",
    "group_name": "Test Group",
    "proposals": [
        {
            "filename": "test.pdf",
            "file_url": "http://example.com/test.pdf",
            "size": 1024
        }
    ]
}'
```

### Using Postman

1. Create new request collection
2. Set base URL: `http://localhost:8000` or your server URL
3. Add headers:
    - `Content-Type: application/json`
    - `Accept: application/json`
4. For file upload APIs, use base64 encoded content

### Using JavaScript (Frontend)

**Send Evaluation Test**:

```javascript
async function sendEvaluationTest(groupId, rubricId, assessmentType) {
    try {
        const response = await fetch("/api/evaluation-test", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            body: JSON.stringify({
                proposal_group: groupId,
                rubric_id: rubricId,
                extra_id: "-",
                assessment_type: assessmentType,
            }),
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }

        const data = await response.json();
        console.log("Success:", data);
        return data;
    } catch (error) {
        console.error("Error:", error);
        throw error;
    }
}

// Usage
sendEvaluationTest(1, 1, "gabungan_selected")
    .then((result) => {
        console.log("AI Response:", result.ai_response);
    })
    .catch((error) => {
        console.error("Failed:", error);
    });
```

**Import Proposal Group**:

```javascript
async function importProposalGroup(groupData) {
    try {
        const response = await fetch("/api/bima/proposal-groups", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            body: JSON.stringify(groupData),
        });

        const data = await response.json();

        if (data.success) {
            console.log("Import successful:", data.data);
            return data;
        } else {
            console.error("Import failed:", data.message);
            throw new Error(data.message);
        }
    } catch (error) {
        console.error("Error:", error);
        throw error;
    }
}

// Usage
const groupData = {
    scheme: "PPDM",
    type: "current",
    path: "training",
    group_name: "Kelompok A 2026",
    proposals: [
        {
            filename: "proposal_001.pdf",
            file_url: "https://example.com/proposal_001.pdf",
            size: 1024000,
        },
    ],
};

importProposalGroup(groupData)
    .then((result) => {
        console.log("Group ID:", result.data.group.id);
    })
    .catch((error) => {
        console.error("Failed to import:", error);
    });
```

**Load and Display Proposals**:

```javascript
async function loadProposals(groupId) {
    try {
        const response = await fetch(
            `/api/proposal-groups/${groupId}/proposals`
        );
        const data = await response.json();

        if (data.success) {
            const proposalsList = document.getElementById("proposals-list");
            proposalsList.innerHTML = "";

            data.proposals.forEach((proposal) => {
                const div = document.createElement("div");
                div.className = "proposal-item";
                div.innerHTML = `
                    <h4>${proposal.filename}</h4>
                    <p>Status: <span class="badge badge-${proposal.status}">${proposal.status}</span></p>
                    <p>Size: ${(proposal.size / 1024).toFixed(2)} KB</p>
                `;
                proposalsList.appendChild(div);
            });
        }
    } catch (error) {
        console.error("Error loading proposals:", error);
    }
}
```

---

## 🔧 Configuration

### Environment Variables

```env
# Application
APP_NAME="Dashboard AI v2"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# AI Service Configuration
AI_MODEL_ENDPOINT=https://your-ai-service.com/api/evaluate

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dashboardai_db
DB_USERNAME=root
DB_PASSWORD=

# File Storage
FILESYSTEM_DISK=public

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file

# CORS (if Web Bima from different domain)
CORS_ALLOWED_ORIGINS=https://bima.upi.edu
```

### CORS Configuration

Edit `config/cors.php`:

```php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [env('CORS_ALLOWED_ORIGINS', '*')],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
```

### Storage Setup

Run these commands to set up storage:

```bash
# Create symbolic link for public storage
php artisan storage:link

# Set permissions (Linux/Mac)
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Create storage directories if not exist
mkdir -p storage/app/public/proposals
mkdir -p storage/app/public/rubrics
mkdir -p storage/app/public/extras
mkdir -p storage/app/public/metadata_files
```

---

## 📊 Database Schema

### Core Tables

#### `proposals` Table

| Field                  | Type         | Description                                |
| ---------------------- | ------------ | ------------------------------------------ |
| id                     | bigint       | Primary key                                |
| proposal_group_id      | bigint       | FK to proposal_groups                      |
| group_code             | string(100)  | Group code reference                       |
| filename               | string(255)  | Original filename                          |
| path                   | string(500)  | Storage path or URL                        |
| size                   | bigint       | File size in bytes                         |
| status                 | string(50)   | uploaded/failed/evaluated                  |
| evaluation_id          | string(100)  | Unique evaluation ID from AI               |
| evaluator_username     | string(255)  | Evaluator username                         |
| evaluation_start_time  | timestamp    | When evaluation started                    |
| processing_time        | string(100)  | Processing duration                        |
| evaluation_status      | string(50)   | lolos/tidak_lolos/dinilai                  |
| assessment_status      | tinyint      | 0=none, 1=admin, 2=subs, 3=both            |
| admin_score            | integer      | Administration score (0-10)                |
| admin_status           | string(50)   | LOLOS/TIDAK LOLOS                          |
| substansi_score        | decimal(5,2) | Weighted substance score (0-100)           |
| substansi_max_score    | decimal(5,2) | Max individual item score                  |
| substansi_min_score    | decimal(5,2) | Min individual item score                  |
| substansi_summary      | text         | Summary from AI evaluation                 |
| ml_result              | string(50)   | LOLOS/TIDAK LOLOS/PENDING                  |
| ai_score               | decimal(5,2) | AI final score                             |
| ai_notes               | text         | Notes from AI evaluation                   |
| json_result            | longtext     | Complete JSON response from AI             |
| created_at             | timestamp    | Creation timestamp                         |
| updated_at             | timestamp    | Last update timestamp                      |

#### `proposal_groups` Table

| Field           | Type        | Description                         |
| --------------- | ----------- | ----------------------------------- |
| id              | bigint      | Primary key                         |
| group_code      | string(100) | Unique group identifier             |
| group_name      | string(255) | Group display name                  |
| scheme          | string(100) | Scheme name (PPDM, PDP, etc.)       |
| type            | string(50)  | current/history                     |
| path            | string(100) | training/test/sekarang              |
| total_files     | integer     | Number of proposals                 |
| uploaded_at     | timestamp   | Upload timestamp                    |
| status          | string(50)  | uploaded/processing/completed       |
| assessment_type | string(50)  | Type of assessment requested        |
| created_at      | timestamp   | Creation timestamp                  |
| updated_at      | timestamp   | Last update timestamp               |

#### `rubrics` Table

| Field        | Type         | Description                      |
| ------------ | ------------ | -------------------------------- |
| id           | bigint       | Primary key                      |
| rubric_name  | string(255)  | Rubric name                      |
| description  | text         | Description (optional)           |
| file_path    | string(500)  | Path to administrasi DOCX file   |
| file_path_2  | string(500)  | Path to substansi DOCX file      |
| schema_id    | bigint       | FK to schemas table              |
| created_at   | timestamp    | Creation timestamp               |
| updated_at   | timestamp    | Last update timestamp            |

#### `metadata` Table

| Field           | Type         | Description                         |
| --------------- | ------------ | ----------------------------------- |
| id              | bigint       | Primary key                         |
| title           | string(255)  | Metadata title                      |
| description     | text         | Description                         |
| abstract        | text         | Abstract                            |
| category        | string(100)  | Category                            |
| field_of_study  | string(100)  | Field of study                      |
| keywords        | string(500)  | Keywords (comma-separated)          |
| researcher_id   | string(100)  | Researcher ID                       |
| researcher_name | string(255)  | Researcher name                     |
| study_program   | string(255)  | Study program                       |
| institution     | string(255)  | Institution name                    |
| year            | integer      | Year                                |
| semester        | string(50)   | Semester (Ganjil/Genap)             |
| upload_code     | string(100)  | Unique upload code                  |
| file_paths      | json         | Array of file paths                 |
| output_type     | string(100)  | Output type                         |
| status          | string(50)   | draft/published/archived            |
| created_at      | timestamp    | Creation timestamp                  |
| updated_at      | timestamp    | Last update timestamp               |

#### `extras` Table

| Field      | Type        | Description            |
| ---------- | ----------- | ---------------------- |
| id         | bigint      | Primary key            |
| extra_name | string(255) | Extra file name        |
| file_path  | string(500) | Storage path           |
| created_at | timestamp   | Creation timestamp     |
| updated_at | timestamp   | Last update timestamp  |

#### `schemas` Table

| Field       | Type        | Description                   |
| ----------- | ----------- | ----------------------------- |
| id          | bigint      | Primary key                   |
| name        | string(255) | Schema name                   |
| description | text        | Description (optional)        |
| schema_data | json        | JSON structure details        |
| type        | string(100) | rubric/instrument/etc         |
| created_at  | timestamp   | Creation timestamp            |
| updated_at  | timestamp   | Last update timestamp         |

---

## 📞 Support

### Troubleshooting

**Issue: AI Service Connection Timeout**

```json
{
    "success": false,
    "message": "Failed to connect to AI Model endpoint"
}
```

Solution:

-   Check `AI_MODEL_ENDPOINT` in `.env`
-   Verify AI service is running
-   Check firewall/network settings
-   Increase timeout in controller if needed

**Issue: File Upload Failed**

```json
{
    "success": false,
    "message": "Failed to store file"
}
```

Solution:

-   Check storage permissions: `chmod -R 775 storage`
-   Verify storage link: `php artisan storage:link`
-   Check available disk space
-   Verify base64 encoding is correct

**Issue: Validation Errors**

```json
{
    "success": false,
    "message": "Validation error",
    "errors": {
        "proposals": ["The proposals field is required."]
    }
}
```

Solution:

-   Check all required fields are present
-   Verify data types match specification
-   Check enum values (e.g., type must be 'current' or 'history')

### Logging

Enable detailed logging in `.env`:

```env
APP_DEBUG=true
LOG_CHANNEL=stack
LOG_LEVEL=debug
```

Check logs:

```bash
# Laravel logs
tail -f storage/logs/laravel.log

# View last 100 lines
tail -n 100 storage/logs/laravel.log

# Search for errors
grep "ERROR" storage/logs/laravel.log
```

### API Testing Tools

-   **Postman**: Full-featured API testing
-   **cURL**: Command-line testing
-   **Insomnia**: REST client alternative
-   **Thunder Client**: VS Code extension

### Contact

For API issues or questions:

-   **Email**: support@dashboardai.com
-   **GitHub Issues**: [Create issue](https://github.com/yogiok1/DashboardAIv2/issues)
-   **Documentation**: [Main README](README.md)

---

## 📝 Complete API Endpoints Summary

### Data Import

| Method | Endpoint            | Description                |
| ------ | ------------------- | -------------------------- |
| POST   | `/api/data/import`  | Import training/test data  |
| GET    | `/api/data/status`  | Get import status          |

### Web Bima Integration

| Method | Endpoint                      | Description                  |
| ------ | ----------------------------- | ---------------------------- |
| POST   | `/api/bima/proposal-groups`   | Import proposal group        |
| GET    | `/api/bima/proposal-groups`   | Get all proposal groups      |
| POST   | `/api/bima/rubrics`           | Import rubric                |
| GET    | `/api/bima/rubrics`           | Get all rubrics              |
| POST   | `/api/bima/metadata`          | Import metadata              |
| GET    | `/api/bima/metadata`          | Get all metadata             |
| POST   | `/api/bima/extras`            | Import extra file            |
| GET    | `/api/bima/extras`            | Get all extras               |

### AI Model Testing

| Method | Endpoint                     | Description                      |
| ------ | ---------------------------- | -------------------------------- |
| POST   | `/api/model/direct-test`     | Direct test to AI model          |
| POST   | `/api/evaluation-test`       | Evaluation test (frontend → AI)  |

### Evaluation Results

| Method | Endpoint                    | Description                      |
| ------ | --------------------------- | -------------------------------- |
| POST   | `/api/evaluation-result`    | Receive results from AI (callback)|

### Proposal Groups

| Method | Endpoint                                  | Description                 |
| ------ | ----------------------------------------- | --------------------------- |
| GET    | `/api/proposal-groups/{id}/proposals`     | Get proposals by group      |

---

## 🆕 Changelog

### Version 2.4 (January 2026)

**New Features**:

-   ✅ Added comprehensive Data Import APIs
-   ✅ Enhanced Proposal Group APIs with filtering
-   ✅ Added Extras API for template files
-   ✅ Improved Metadata API with multiple file support
-   ✅ Added detailed database schema documentation
-   ✅ Enhanced error handling documentation

**Improvements**:

-   📝 Updated all JSON examples to match actual implementation
-   📝 Added complete field descriptions
-   📝 Added troubleshooting guide
-   📝 Added storage configuration guide
-   📝 Enhanced testing examples with JavaScript

**API Changes**:

-   Changed `file_base64` to `file_content` for consistency
-   Added `assessment_status` field (0-3) in evaluation results
-   Added `assessment_type` options: administrasi, substansi, gabungan_naive, gabungan_selected
-   Improved ML result normalization (Lolos → LOLOS, Tidak Lolos → TIDAK LOLOS)

### Version 2.3 (December 2025)

-   Added Schema Management
-   Enhanced Rubrics with dual file support
-   Processing time tracking improvements
-   Enhanced evaluation result structure

---

**Version**: 2.4  
**Last Updated**: January 3, 2026  
**Repository**: [yogiok1/DashboardAIv2](https://github.com/yogiok1/DashboardAIv2)
