<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalGroup;
use App\Models\Rubric;
use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class ToolsController extends Controller
{
    public function index()
    {
        // Redirect ke halaman baru dengan 3 pilihan assessment
        return view('tools.index');
    }

    public function test($type)
    {
        // Validasi assessment type dengan 4 tipe baru
        $validTypes = ['administrasi', 'substansi', 'gabungan_naive', 'gabungan_selected'];
        if (!in_array($type, $validTypes)) {
            abort(404, 'Invalid assessment type');
        }

        // Ambil Proposal Group yang tipe CURRENT saja
        $groups = ProposalGroup::where('type', 'current')
            ->orderBy('uploaded_at', 'desc')
            ->get()
            ->map(function($group) {
                // Tambahkan suffix assessment_type jika bukan '-'
                $displayName = $group->group_name;
                if ($group->assessment_type && $group->assessment_type !== '-') {
                    $displayName .= ' - ' . $group->assessment_type;
                }
                $group->display_name = $displayName;
                return $group;
            });

        // Debug: Log jumlah groups
        \Log::info('Tools Test - Assessment Type: ' . $type . ', Groups Count: ' . $groups->count());

        // Ambil semua proposal untuk group CURRENT
        $proposals = Proposal::whereIn(
            'proposal_group_id',
            $groups->pluck('id')->toArray()
        )
            ->orderBy('id', 'asc')
            ->get();

        // Ambil semua instrument (rubrics)
        $rubrics = Rubric::orderBy('rubric_name', 'asc')->get();
        
        // Ambil semua extras (optional additional files)
        $extras = Extra::orderBy('extra_name', 'asc')->get();

        // Prepare data berdasarkan tipe assessment
        $assessmentType = $type;
        
        // Set label, icon, dan styling berdasarkan tipe
        $config = $this->getAssessmentConfig($type);

        return view('tools.test', array_merge(compact(
            'groups', 
            'proposals', 
            'rubrics', 
            'extras',
            'assessmentType'
        ), $config));
    }

    private function getAssessmentConfig($type)
    {
        $configs = [
            'administrasi' => [
                'assessmentTypeLabel' => 'Administratif',
                'assessmentDescription' => 'Menilai persyaratan administratif dan kelengkapan dokumen proposal.',
                'icon' => 'fa-file-alt',
                'iconClass' => 'text-blue-600 dark:text-blue-400',
                'badgeClass' => 'text-blue-800 bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300',
                'gradientClass' => 'bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20',
                'buttonClass' => 'bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300',
            ],
            'substansi' => [
                'assessmentTypeLabel' => 'Substantif',
                'assessmentDescription' => 'Menilai kualitas konten dan substansi isi proposal penelitian.',
                'icon' => 'fa-clipboard-check',
                'iconClass' => 'text-orange-600 dark:text-orange-400',
                'badgeClass' => 'text-orange-800 bg-orange-100 dark:bg-orange-900/30 dark:text-orange-300',
                'gradientClass' => 'bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20',
                'buttonClass' => 'bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300',
            ],
            'gabungan_naive' => [
                'assessmentTypeLabel' => 'Proses Semua',
                'assessmentDescription' => 'Penilaian gabungan administratif dan substantif secara bersamaan tanpa melakukan filter proposal (keseluruhan proposal). Sebagai contoh, kita memiliki 100 file proposal lalu semua file proposal akan dinilai administratif dan substantif sekaligus tanpa ada penyaringan terlebih dahulu.',
                'icon' => 'fa-layer-group',
                'iconClass' => 'text-purple-600 dark:text-purple-400',
                'badgeClass' => 'text-purple-800 bg-purple-100 dark:bg-purple-900/30 dark:text-purple-300',
                'gradientClass' => 'bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20',
                'buttonClass' => 'bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300',
            ],
            'gabungan_selected' => [
                'assessmentTypeLabel' => 'Proses Semua dengan Filter',
                'assessmentDescription' => 'Penilaian gabungan administratif dan substantif dengan melakukan filter proposal (hanya proposal yang lolos seleksi administrasi). Sebagai contoh, kita memiliki 100 file proposal lalu sistem akan menilai semua 100 file tersebut secara administratif terlebih dahulu, kemudian hanya file yang lolos seleksi administratif saja yang akan dinilai secara substantif.',
                'icon' => 'fa-filter',
                'iconClass' => 'text-green-600 dark:text-green-400',
                'badgeClass' => 'text-green-800 bg-green-100 dark:bg-green-900/30 dark:text-green-300',
                'gradientClass' => 'bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20',
                'buttonClass' => 'bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300',
            ],
        ];

        return $configs[$type];
    }

    public function run2(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'scheme' => 'required|string',
            'filename' => 'required|array',
            'filepath' => 'required|array',
            'status' => 'required|array',
        ]);

        // Susun data proposals
        $proposals = [];
        foreach ($request->filename as $i => $file) {
            $proposals[] = [
                'id_proposal' => $i + 1,
                'filename'    => $file,
                'filepath'    => $request->filepath[$i] ?? '',
                'status'      => $request->status[$i] ?? '',
            ];
        }

        // JSON final
        $json = [
            "username"        => "demo-user",
            "instrument_path" => "instrumen",
            "scheme"          => $request->scheme,
            "year"            => 2026,
            "proposals"       => $proposals
        ];
        // Kembalikan JSON
        return response()->json([
            "success" => true,
            "message" => "Laravel menerima data",
            "data" => $request->all()
        ]);
    }

    public function run(Request $request)
    {
        // 1. Ambil instrument (rubric)
        $rubric = Rubric::find($request->rubric_id);
        
        // Build instrument object dengan file administrasi & substansi
        $instrument = [];
        if ($rubric) {
            if ($rubric->file_path) {
                $instrument['administrasi'] = "http://72.61.215.182/storage/" . $rubric->file_path;
            }
            if ($rubric->file_path_2) {
                $instrument['substansi'] = "http://72.61.215.182/storage/" . $rubric->file_path_2;
            }
        }

        // 2. Ambil proposal group
        $group = ProposalGroup::find($request->proposal_group);

        // 3. Ambil daftar proposal sesuai group
        $proposals = Proposal::where('proposal_group_id', $group->id)->get();

        // 4. Ambil year dari timestamp grup (integer)
        $year = $group->uploaded_at ? (int) $group->uploaded_at->format('Y') : (int) date('Y');
        
        // 5. Get extra path if selected
        $extraPath = "-"; // Default jika tidak dipilih atau pilih '-'
        if ($request->extra_id && $request->extra_id !== '-') {
            $extra = Extra::find($request->extra_id);
            if ($extra) {
                $extraPath = "http://72.61.215.182/storage/" . $extra->file_path;
            }
        }
        
        // 6. Get scheme from rubric name
        $scheme = $rubric ? $rubric->rubric_name : "Unknown";

        // 7. Get assessment_type from request
        $assessmentType = $request->assessment_type ?? 'gabungan_naive';
        
        // 8. Update assessment_type di proposal_group
        if ($group) {
            $group->assessment_type = $assessmentType;
            $group->save();
        }

        // 9. Bentuk JSON final dengan assessment_type
        $payload = [
            "username" => Auth::check() ? Auth::user()->name : "anonymous",
            "scheme" => $scheme,
            "year" => $year,
            "assessment_type" => $assessmentType,
            "ml_sub" => true, // Hardcoded default value
            "instrument" => $instrument,
            "extra_path" => $extraPath,
            "proposal_group" => $group->id,
            "proposals" => $proposals->map(function ($p) {
                return [
                    "id_proposal" => $p->id,
                    "filename" => $p->filename,
                    "filepath" => "http://72.61.215.182/storage/" . $p->path,
                    "status" => $p->assessment_status ?? 0,
                ];
            })->values()->all()
        ];

        // 10. Fire and forget - kirim ke API eksternal tanpa tunggu response
        $apiEndpoint = env('AI_MODEL_ENDPOINT');
        
        Http::withOptions(['timeout' => 1])->async()->post(
            $apiEndpoint,
            $payload
        );

        // 11. Langsung kembalikan status terkirim
        return response()->json([
            "success" => true,
            "message" => "Request has been sent to AI service",
            "sent_payload" => $payload,
            "api_endpoint" => $apiEndpoint,
            "timestamp" => date('Y-m-d H:i:s')
        ]);
    }
}
